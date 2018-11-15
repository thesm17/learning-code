var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, next) {
  res.redirect('/catalog');
});

module.exports = router;
