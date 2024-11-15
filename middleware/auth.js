require("dotenv").config();
const jwt = require("jsonwebtoken"),
jwt_token = process.env.JWT_TOKEN

// Funktion, die eine Middleware zurückgibt, die die erforderliche Rolle akzeptiert
exports.roleAuth = (requiredRole) => {
    return (req, res, next) => {
        const token = req.cookies.jwt;
        console.log("Token:", token);
        if(token){
            jwt.verify(token, jwt_token, (e, decodedToken) => {
                if(e) {
                    console.log("JWT Fehler:", e);
                    return res.status(401).json({message: "not authorized"})
                } else {
                    console.log("Decoded Token:", decodedToken);
                    if (!decodedToken || !decodedToken.role) {
                        return res.status(401).json({ message: "not authorized, role is not available" });
                    }
                    if(decodedToken.role !== requiredRole) {
                        return res.status(401).json({message: "not authorized"})
                    } else {
                        next();
                    }
                }
            })
        } else {
            return res.status(401).json({message: "not authorized, token is not available"})
        }
    }
}