import './bootstrap';
import '../sass/app.scss';

import AOS from 'aos';
import 'aos/dist/aos.css';
import { gsap } from 'gsap';
import Swiper, { Navigation, Pagination, Thumbs, Autoplay } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/thumbs';

document.addEventListener('DOMContentLoaded', () => {
	AOS.init({ once: true, duration: 700, easing: 'ease-in-out' });
	window.gsap = gsap;

	// Hero slider
	const heroEl = document.querySelector('.swiper-hero');
	if (heroEl) {
		new Swiper(heroEl, {
			modules: [Navigation, Pagination, Autoplay],
			loop: true,
			slidesPerView: 1,
			navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
			pagination: { el: '.swiper-pagination', clickable: true },
			autoplay: { delay: 4000, disableOnInteraction: false }
		});
	}

	// Product gallery (thumbs)
	const galleryTopEl = document.querySelector('.gallery-top');
	const galleryThumbsEl = document.querySelector('.gallery-thumbs');
	if (galleryTopEl && galleryThumbsEl) {
		const thumbs = new Swiper(galleryThumbsEl, { modules: [Thumbs], spaceBetween: 8, slidesPerView: 4, freeMode: true, watchSlidesProgress: true });
		new Swiper(galleryTopEl, { modules: [Navigation, Thumbs], spaceBetween: 10, navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }, thumbs: { swiper: thumbs } });
	}
});
