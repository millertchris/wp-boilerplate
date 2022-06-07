import mainMenu from "./components/main-menu";
import AOS from "aos";
import Rellax from "rellax";

document.addEventListener("DOMContentLoaded", function () {
	var rellax = new Rellax(".rellax", {
		center: true,
	});
	AOS.init();
	mainMenu();
});
