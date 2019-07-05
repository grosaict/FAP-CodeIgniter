Vue.component('list-cart', {
    props:  ['cartlist'],
    template: ' <div>\
                    <div v-if="!cartlist" v-on:mouseover="refresh_cart">\
                        CARRINHO VAZIO!!!\
                    </div>\
                    <div v-else>\
                        <div v-on:mouseover="refresh_cart">\
                            <button class="w3-left w3-round w3-hover-red" v-on:click="clean_cart()" v-on:hover="refresh_cart()">Limpar Carrinho</button>\
                            <button class="w3-right w3-round w3-hover-red" v-on:click="show_order_form()">Realizar Pedido</button>\
                            </br>\
                            <h1><b>Total</b> <span class="w3-right w3-tag w3-dark-grey w3-round">R${{cartlist.length * 43}},00</span></h1>\
                            <hr>\
                        </div>\
                        <div id="order_form" style="display:none">\
                            <form action="submit_order(cartlist)">\
                                <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Nome" required name="name"></p>\
                                <p><input class="w3-input w3-padding-16 w3-border" type="number" placeholder="(__) _____-____" required name="mobile"></p>\
                                <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Pedido Especial" name="message"></p>\
                                <p><button class="w3-button w3-light-grey w3-block w3-hover-red" type="submit">ENVIAR</button></p>\
                            </form>\
                        </div>\
                        <span v-for="(cart_item, index) of cartlist">\
                            <h1><b>{{cart_item.pizza}}</b> <span class="w3-right w3-tag w3-dark-grey w3-round">R$43,00</span></h1>\
                            <span class="w3-text-grey" v-for="ing of cart_item.ingredients"> {{ing.ingredient}}, </span>\
                            <button class="w3-right w3-round w3-hover-red" v-on:click="remove_from_cart(index)">Remover</button>\
                            <hr>\
                        </span>\
                    </div>\
                </div>',
    methods:
    {
        remove_from_cart: function (index_cart)
        {
            axios
                .delete('http://localhost:8888/api/cart/delete_pizza_cart/'+index_cart)
                .then(response=>{
                    console.log("Response (refresh cart[del]): ", response.data);
                    this.refresh_cart();
                });
        },
        clean_cart: function ()
        {
            axios
                .delete('http://localhost:8888/api/cart/clean_cart')
                .then(response=>{
                    console.log("Response (refresh cart[clean]): ", response.data);
                    this.refresh_cart();
                });
        },
        refresh_cart: function()
        {
            this.$emit('bind_get_cart');
        },
        show_order_form: function()
        {
            document.getElementById('order_form').style.display = "block";
        },
        submit_order: function (cart)
        {
            axios
                .post('http://localhost:8888/api/order', cart)
                .then(response=>{
                    console.log("Response (order): ", response);
                });
        },
    },
})

var app = new Vue({
    el: "#Cart",
    data: {
        cart:[]
    },
    methods: {
        get_cart: function (){
            axios
                .get('http://localhost:8888/api/cart/get_cart')
                .then(response=>{
                    this.cart = response.data;
                    console.log("Response (cart): ", this.cart);
                });
        },
    },
    created: function() {
        this.get_cart();
    },
    // updated: function(){       DEIXA RENDERIZANDO EM LOOPING!!!!
    //     this.get_cart();
    // }
});