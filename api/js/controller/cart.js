Vue.component('list-cart', {
    props:  ['cartlist', 'total_cart'],
    template: ' <div>\
                    <div v-if="!cartlist" v-on:mouseover="refresh_cart">\
                        CARRINHO VAZIO!!!\
                    </div>\
                    <div v-else>\
                        <div v-on:mouseover="refresh_cart">\
                            <button class="w3-left w3-round w3-hover-red" v-on:click="clean_cart()">Limpar Carrinho</button>\
                            <button class="w3-right w3-round w3-hover-red" v-on:click="show_order_form()">Realizar Pedido</button>\
                            </br>\
                            <h1><b>Total</b> <span class="w3-right w3-tag w3-dark-grey w3-round">{{ total_cart | currency("R$", 2, { decimalSeparator: "," }) }}</span></h1>\
                            <hr>\
                        </div>\
                        <div id="order_form" style="display:none">\
                            <form action="" method="post">\
                                <p><input class="w3-input w3-padding-16 w3-border" type="text" id="name_client" name="name_client" size="66" maxlength="66" placeholder="Nome" required></p>\
                                <p><input class="w3-input w3-padding-16 w3-border" type="number" id="mobile" name="mobile" placeholder="celular" required></p>\
                                <p><input class="w3-input w3-padding-16 w3-border" type="text" id="message" name="message" size="100" maxlength="100" placeholder="Pedido Especial"></p>\
                                <p><input class="w3-input w3-padding-16 w3-border" name="cep" type="text" id="cep" value="" size="10" maxlength="9" placeholder="CEP"></p>\
                                <p class="w3-center" id="form-message"><span class="w3-tag w3-xxlarge w3-red">PREENCHA SEUS DADOS PARA PROSSEGUIR</span></p>\
                                <div id="allow-submit" style="display:none">\
                                    <p><span class="w3-text-grey" id="rua"></span>\
                                        <label>, \
                                            <input class="w3-padding-16 w3-border w3-center w3-border-red" name="nro" type="text" id="nro" placeholder="número" size="10"/>\
                                        </label>\
                                    </p>\
                                    <p><label>Referência/Apartamento:<input class="w3-input w3-padding-16 w3-border w3-border-red" name="complemento" type="text" id="complemento" value="" size="10"/></label></p>\
                                    <p><span class="w3-text-grey" id="bairro"></span></p>\
                                    <p><span class="w3-text-grey" id="cidade"></span><span> / </span><span class="w3-text-grey" id="uf"></span></p>\
                                    <p><button class="w3-button w3-light-grey w3-block w3-hover-red" v-on:click="submit_order()">ENVIAR</button></p>\
                                </div>\
                            </form>\
                        </div>\
                        <span v-for="(cart_item, index) of cartlist">\
                            <h1><b>{{cart_item.pizza}}</b> <span class="w3-right w3-tag w3-dark-grey w3-round">{{ cart_item.price | currency("R$", 2, { decimalSeparator: "," }) }}</span></h1>\
                            <span class="w3-text-grey" v-for="ing of cart_item.ingredients"> {{ing.ingredient}}, </span>\
                            <button class="w3-right w3-round w3-hover-red" v-on:click="remove_from_cart(index)">Remover</button>\
                            <hr>\
                        </span>\
                    </div>\
                </div>',
    methods:
    {
        refresh_cart: function()
        {
            this.$emit('bind_get_cart');
        },
        remove_from_cart: function (index_cart)
        {
            axios
                .delete('http://localhost:8888/api/cart/delete_pizza_cart/'+index_cart)
                .then(this.refresh_cart());
        },
        clean_cart: function ()
        {
            axios
                .delete('http://localhost:8888/api/cart/clean_cart')
                .then(this.refresh_cart());
        },
        show_order_form: function()
        {
            $('#order_form').show();
        },
        submit_order: function ()
        {
            client                  = new Client();
            client.name_client      = $("#name_client").val().toUpperCase();
            client.mobile_client    = $("#mobile").val();
            client.message_client   = $("#message").val().toUpperCase();
            client.cep              = $("#cep").val();
            client.rua              = $("#rua").html();
            client.nro              = $("#nro").val();
            client.complemento      = $("#complemento").val();
            client.bairro           = $("#bairro").html();
            client.cidade           = $("#cidade").html();
            client.uf               = $("#uf").html();

            if (Boolean(client.name_client.replace(" ", "")) && Boolean(client.mobile_client) && Boolean(client.cep)) {
                this.refresh_cart();
                axios
                    .post('http://localhost:8888/api/order', client)
                    .then(response=>{
                        console.log("Response (submit_order): ", response.data);
                    });
                } else {
                    alert("Favor preencher todos os campos.");
                }
        },
    },
})

var app = new Vue({
    el: "#Cart",
    data: {
        cart:[],
        total_cart:{},
        orders:[]
    },
    mixins: [Vue2Filters.mixin],
    methods: {
        get_cart: function (){
            axios
                .get('http://localhost:8888/api/cart/get_cart')
                .then(response=>{
                    this.cart = response.data;
                    console.log("Response (get_cart->cart): ", this.cart);
                });
            axios
                .get('http://localhost:8888/api/cart/total_cart')
                .then(response=>{
                    this.total_cart = response.data;
                });
            axios
                .get('http://localhost:8888/api/order')
                .then(response=>{
                    this.orders = response.data;
                    console.log("Response (get_cart->get_last_orders): ", this.orders);
                });
        },
    },
    created: function() {
        this.get_cart();
    },
    // updated: function(){       RENDERIZA EM LOOPING!!!!
    //     this.get_cart();
    // }
});