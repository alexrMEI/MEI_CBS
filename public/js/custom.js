function openCart() {
	var cart = document.getElementById('cart');
	if (!cart.classList.contains('opened')) document.getElementById('cart').classList.add('opened');
}
function closeCart() {
	var cart = document.getElementById('cart');
	if (cart.classList.contains('opened')) document.getElementById('cart').classList.remove('opened');
}