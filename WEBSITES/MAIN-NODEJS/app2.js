//jshint esversion:6

const express = require("express");
const bodyParser = require("body-parser");
const ejs = require("ejs");
const axios = require('axios');
const fetch = require('node-fetch');


const port = process.env.PORT || 3000;
const app = express();


app.use(bodyParser.urlencoded({extended: true}));
app.use(express.static(__dirname + '/public'));
app.set('view engine', 'ejs');

app.get("/", function (req,res) {

  res.render("inicio", {
    primero: ""
  });
  
});

app.get("/juegos/minecraft", function (req,res) {

  res.render("minecraft", {});

});

app.get("/terminos-y-condiciones", function (req,res) {

  res.render("footerEnlaces/terminos", {
  });

});

app.get("/politica-privacidad", function (req,res) {

  res.render("footerEnlaces/privacidad", {
  });

});

app.get("/faq", function (req,res) {

  res.render("footerEnlaces/faq", {
  });

});

app.get("/contacto", function (req,res) {

  res.render("footerEnlaces/contacto", {});

});

app.use((req, res, next) => {
  res.status(404).render("error404", {});
});


app.listen(port, function() {
  console.log("El servidor esta escuchando en el puerto: " + port);
});
