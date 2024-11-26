import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import feather from "feather-icons";
import "./styles/app.css";
import "./styles/custom.css";
import "./styles/carousel.css";
// Import Bootstrap JavaScript
import "bootstrap/dist/js/bootstrap.bundle.min.js";

// Import custom global JavaScript
//import "./js/global.js";a effacer

feather.replace(); // Initialisation des icônes Feather
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

console.log("This log comes from assets/app.js - welcome to AssetMapper! 🎉");
