Vue.component('list-cart', {
    props:  ['cartlist'],
    template: ' <div>\
                    <div v-if="!cartlist">\
                        CARRINHO VAZIO!!!\
                    </div>\
                    <span v-for="(cart_item, index) of cartlist">\
                        <h1><b>{{cart_item.pizza}}</b> <span class="w3-right w3-tag w3-dark-grey w3-round">R$43.00</span></h1>\
                        <span class="w3-text-grey" v-for="ing of cart_item.ingredients"> {{ing.ingredient}}, </span>\
                        <button class="w3-right w3-round w3-hover-red" v-on:click="remove_from_cart(index)">Remover</button>\
                        <hr>\
                    </span>\
                </div>',
    methods:
    {
        remove_from_cart: function (index_cart)
        {
            axios
                .delete('http://localhost:8888/api/cart/delete_pizza_cart/'+index_cart)
                .then(response=>{
                    console.log("Response (refresh cart[del]): ", response.data);
                    //Object.assign(app.cart, response.data);
                    this.$emit('getCart()');
                });
        },
    },
})

var app = new Vue({
    el: "#Cart",
    data: {
        cart:[]
    },
    methods:{
        getCart: function (){
            axios
                .get('http://localhost:8888/api/cart/get_cart')
                .then(response=>{
                    this.cart = response.data;
                    console.log("Response (cart): ", this.cart);
                });
        },
    },
    created: function(){
        this.getCart();
    },
    // updated: function(){       DEIXA RENDERIZANDO EM LOOPING!!!!
    //     this.getCart();
    // }
});