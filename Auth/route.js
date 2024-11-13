const express = require('express'),
router = express.Router(),
{register, login, update, deleteUser} = require('./Auth')
const { roleAuth } = require('../middleware/auth.js')


router.route("/register").post(register)
router.route("/login").post(login)
router.route("/update").put(roleAuth("admin"), update)
router.route("/delete").delete(roleAuth("admin"), deleteUser)
module.exports = router