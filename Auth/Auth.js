require("dotenv").config();
const userModel = require("../model/user.js");
const bcrypt = require("bcrypt");
const jwt = require("jsonwebtoken");
const jwt_token = process.env.JWT_TOKEN;

const Roles = {
    ADMIN: "admin",
    Notenwart: "notenwart",
    Vorstand: "vorstand",
    USER: "user",
    // Füge hier weitere Rollen hinzu, die du unterstützen möchtest
};

exports.register = async (req, res, next) => {
    const { username, password } = req.body;
    if (password.length < 8) {
        return res.status(400).json({ message: "Passwort ist zu kurz! Mindestens 8 Zeichen lang" });
    }
    try {
        const hash = await bcrypt.hash(password, 10);
        const user = await userModel.create({
            username,
            password: hash,
            role: "user" // Standardrolle setzen
        });
        
        // JWT generieren
        const maxAge = 3 * 60 * 60; // Token-Gültigkeitsdauer in Sekunden
        const token = jwt.sign({ id: user._id, username, role: user.role }, jwt_token, { expiresIn: maxAge });
        
        // Cookie setzen
        res.cookie("jwt", token, {
            httpOnly: true,
            maxAge: maxAge * 1000
        });

        // Weiterleitung basierend auf der Rolle
        return res.status(201).json({
            message: "Benutzer erfolgreich registriert",
            user: user._id,
            role: user.role // Rolle zurückgeben
        });
        
    } catch (e) {
        res.status(500).json({ message: "Fehler bei der Registrierung", error: e.message });
    }
};

exports.login = async (req, res, next) => {
    const { username, password } = req.body;
    if (!username || !password) {
        return res.status(400).json({ message: "Ungültiger Login" });
    }
    try {
        const foundUser = await userModel.findOne({ username });
        if (!foundUser) {
            return res.status(401).json({ message: "Login Fehlerhaft! Überprüfe deine Angaben!", error: "User not Found" });
        }
        const isMatch = await bcrypt.compare(password, foundUser.password);
        if (!isMatch) {
            return res.status(401).json({ message: "Login Fehlerhaft! Überprüfe deine Angaben!", error: "Password incorrect" });
        }

        // JWT generieren
        const maxAge = 3 * 60 * 60; // Token-Gültigkeitsdauer in Sekunden
        const token = jwt.sign({ id: foundUser._id, username: foundUser.username, role: foundUser.role }, jwt_token, { expiresIn: maxAge });

        // Antwort anpassen
        res.status(200).json({
            message: "Login erfolgreich",
            user: foundUser._id, // Nur die Benutzer-ID zurückgeben
            token: token // Token zurückgeben
        });
    } catch (e) {
        res.status(500).json({ message: "Fehler beim Login", error: e.message });
    }
};

exports.update = async (req, res, next) => {
    const { role, id } = req.body;
    if (role && id) {
        if (Object.values(Roles).includes(role)) {
            try {
                const user = await userModel.findById(id);
                if (user.role !== Roles.ADMIN) {
                    user.role = role;
                    await user.save();
                    res.status(201).json({ message: "Benutzerrolle erfolgreich aktualisiert", user });
                } else {
                    res.status(400).json({ message: "Der Benutzer hat bereits die Rolle 'Admin'" });
                }
            } catch (e) {
                res.status(400).json({ message: "Fehler bei der Aktualisierung", error: e.message });
            }
        } else {
            res.status(400).json({ message: "Die angegebene Rolle ist ungültig" });
        }
    } else {
        res.status(400).json({ message: "Rolle oder ID sind nicht angegeben" });
    }
};

exports.deleteUser = async (req, res, next) => {
    const { id } = req.body;
    try {
        const user = await userModel.findById(id);
        if (!user) {
            return res.status(404).json({ message: "User nicht gefunden" });
        }
        await userModel.deleteOne({ _id: id });
        res.status(201).json({ message: "User wurde erfolgreich gelöscht" });
    } catch (e) {
        res.status(400).json({ message: "Fehler beim Löschen des Users", error: e.message });
    }
};