require('dotenv').config();

const mongoose = require("mongoose");
const MongoDB = process.env.MONGO_URL;

const connectDB = async () => {
    try {
        await mongoose.connect(MongoDB);
        console.log("MongoDB is Connected");
    } catch (error) {
        console.error("Error connecting to MongoDB:", error);
        process.exit(1);
    }
};

module.exports = connectDB;

