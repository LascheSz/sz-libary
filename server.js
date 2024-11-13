// Umgebungsvariablen laden
require('dotenv').config()

// Abhängigkeiten importieren
const express = require('express'),
    app = express(),
    PORT = process.env.PORT || 3000,
    connectDB = require('./config/database.js'),
    cookieParser = require('cookie-parser'),
    { roleAuth } = require('./middleware/auth.js')

// Middleware einrichten
app.use(cookieParser());
app.use(express.json());

// Datenbankverbindung herstellen
connectDB();

// Routen definieren
app.set("view engine", "ejs");

app.get("/", (req, res) => {
    res.render("home");
});

app.get("/register", (req, res) => {
    res.render("register");
});

app.get("/login", (req, res) => {
    res.render("login");
});

app.get("/admin", roleAuth('admin'), (req, res) => {
    res.render("admin");
});

app.get("/basic", roleAuth('user'), (req, res) => {
    res.send("Basic Route");
});

// Authentifizierungsrouten
app.use("/api/auth", require("./Auth/route.js"));

// Server starten
console.log("MONGO_URL:", process.env.MONGO_URL);
const Server = app.listen(PORT, () => {
    console.log("Server läuft erfolgreich auf Port " + PORT);
});

// Fehlerbehandlung für unhandled Rejections
process.on('unhandledRejection', e => {
    console.log("Fehler aufgetreten: " + e.message);
    Server.close(() => {
        process.exit(1);
    });
});