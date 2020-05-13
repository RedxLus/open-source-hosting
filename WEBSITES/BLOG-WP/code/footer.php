<!--Footer-->
<footer class="bg-white">
	<div class="container mx-auto px-8">

		<div class="w-full flex flex-col md:flex-row py-6">

			<div class="flex-1 mb-6">

				<a class="text-blue-600 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="/">
					LUDIBA
				</a><BR></BR>
				<a class="text-blue-400 no-underline hover:no-underline font-bold text-2xl lg:text-3xl" href="/">
					GROUP
				</a>
			</div>


			<div class="flex-1">
				<p class="uppercase text-gray-500 md:mb-6">Links interés</p>
				<ul class="list-reset mb-6">
					<li class="mt-2 inline-block mr-2 md:block md:mr-0">
						<a href="/faq" class="no-underline hover:underline text-gray-800 hover:text-orange-500">Preguntas (FAQ)</a>
					</li>
					<li class="mt-2 inline-block mr-2 md:block md:mr-0">
						<a href="/contacto" class="no-underline hover:underline text-gray-800 hover:text-orange-500">Contacto</a>
					</li>
				</ul>
			</div>
			<div class="flex-1">
				<p class="uppercase text-gray-500 md:mb-6">Legal</p>
				<ul class="list-reset mb-6">
					<li class="mt-2 inline-block mr-2 md:block md:mr-0">
						<a href="/terminos-y-condiciones" class="no-underline hover:underline text-gray-800 hover:text-orange-500">Términos y condiciones</a>
					</li>
					<li class="mt-2 inline-block mr-2 md:block md:mr-0">
						<a href="/politica-privacidad" class="no-underline hover:underline text-gray-800 hover:text-orange-500">Política de privacidad</a>
					</li>
				</ul>
			</div>
			<div class="flex-1">
				<p class="uppercase text-gray-500 md:mb-6">Redes sociales</p>
				<ul class="list-reset mb-6">
					<li class="mt-2 inline-block mr-2 md:block md:mr-0">
						<a href="https://blog.ludiba.org"
							class="no-underline hover:underline text-gray-800 hover:text-orange-500">Blog</a>
					</li>
					<li class="mt-2 inline-block mr-2 md:block md:mr-0">
						<a href="https://www.linkedin.com/in/luis-dieguez-barrio/"
							class="no-underline hover:underline text-gray-800 hover:text-orange-500">Linkedin</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>

<script>
	var scrollpos = window.scrollY;
	var header = document.getElementById("header");
	var navcontent = document.getElementById("nav-content");
	var navaction = document.getElementById("navAction");
	var brandname = document.getElementById("brandname");
	var toToggle = document.querySelectorAll(".toggleColour");

	document.addEventListener('scroll', function () {

		/*Apply classes for slide in bar*/
		scrollpos = window.scrollY;

		if (scrollpos > 10) {
			header.classList.add("bg-white");
			navaction.classList.remove("bg-white");
			navaction.classList.add("gradient");
			navaction.classList.remove("text-gray-800");
			navaction.classList.add("text-white");
			//Use to switch toggleColour colours
			for (var i = 0; i < toToggle.length; i++) {
				toToggle[i].classList.add("text-gray-800");
				toToggle[i].classList.remove("text-white");
			}
			header.classList.add("shadow");
			navcontent.classList.remove("bg-gray-100");
			navcontent.classList.add("bg-white");
		} else {
			header.classList.remove("bg-white");
			navaction.classList.remove("gradient");
			navaction.classList.add("bg-white");
			navaction.classList.remove("text-white");
			navaction.classList.add("text-gray-800");
			//Use to switch toggleColour colours
			for (var i = 0; i < toToggle.length; i++) {
				toToggle[i].classList.add("text-white");
				toToggle[i].classList.remove("text-gray-800");
			}

			header.classList.remove("shadow");
			navcontent.classList.remove("bg-white");
			navcontent.classList.add("bg-gray-100");

		}

	});
</script>

<script>
	/*Toggle dropdown list*/
	/*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

	var navMenuDiv = document.getElementById("nav-content");
	var navMenu = document.getElementById("nav-toggle");

	document.onclick = check;

	function check(e) {
		var target = (e && e.target) || (event && event.srcElement);

		//Nav Menu
		if (!checkParent(target, navMenuDiv)) {
			// click NOT on the menu
			if (checkParent(target, navMenu)) {
				// click on the link
				if (navMenuDiv.classList.contains("hidden")) {
					navMenuDiv.classList.remove("hidden");
				} else {
					navMenuDiv.classList.add("hidden");
				}
			} else {
				// click both outside link and outside menu, hide menu
				navMenuDiv.classList.add("hidden");
			}
		}

	}

	function checkParent(t, elm) {
		while (t.parentNode) {
			if (t == elm) {
				return true;
			}
			t = t.parentNode;
		}
		return false;
	}
</script>


</body>

</html>