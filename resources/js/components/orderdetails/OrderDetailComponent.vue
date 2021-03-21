<template>
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h4 class="text-blue h4">Order Details for Order {{ fields.order_number }}</h4>
            </div>
            <div class="pull-right">
                <!-- refresh data button -->
                <button @click.prevent="getOrderDetails(page = 1)" class="btn btn-sm btn-round btn-outline-info" :disabled="isDisabled">
                    <div v-if="busy"><i class="fa fa-refresh fa-spin fa-fw"></i> </div>
                    <div v-else><i class="fa fa-refresh"></i> </div>
                </button>
                <!-- export buttons -->
                <span v-if="orderdets.total != 0">
                        <!-- <button @click.prevent="" class="btn btn-sm btn-round btn-outline-success" :disabled="isDisabled">
                            <div v-if="busy1"><i class="icon-copy fa fa-file-excel-o"></i> <i class="fa fa-refresh fa-spin fa-fw"></i></div>
                            <div v-else><i class="icon-copy fa fa-file-excel-o"></i> Excel</div>
                        </button> -->
                </span>
            </div>
        </div>
        <!-- data table -->
        <div class="table-responsive">
            <div v-if="orderdets.total == 0" class="p-3 border border-light text-center">
                Sorry! No Order Products has been added yet.
            </div>
            <table v-else class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Products</th>
                        <th scope="col">Suppliers</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Products</th>
                        <th scope="col">Suppliers</th>
                        <th scope="col">Actions</th>
                    </tr>
                </tfoot>
                <div v-if="busy" class="text-center">Please wait. Loading...<i class="micon fa fa-refresh fa-spin fa-fw"></i></div>
                <tbody v-else>
                    <tr v-for="data in orderdets.data" :key="data.id">
                        <td>{{ data.id }}</td>
                        <td>{{ data.order_detail_product.name }}</td>
                        <td>
                            <span v-if="data.order_detail_product.product_supplier_products.length >  0">
                                <ul v-for="supplier in data.order_detail_product.product_supplier_products" :key="supplier.id">
                                    <li v-if="supplier.supplierproduct_supplier != null"><a :href="'/supplier-products/'+supplier.supplierproduct_supplier.id+'-'+supplier.supplierproduct_supplier.name">{{ supplier.supplierproduct_supplier.name }}</a></li>
                                    <li v-else>No Suppliers</li>
                                </ul>
                            </span>
                        </td>
                        <td>
                            <button @click="onChange(data)" class="btn btn-sm btn-round btn-outline-* btn-warning" :data-target="'#edit'+data.id" data-toggle="modal" title="Edit"><i class="icon-copy fa fa-edit"></i></button>
                            <button @click.prevent="deleteItem('deleteorderdetspath',data.id)" class="btn btn-sm btn-round btn-outline-* btn-danger" title="Delete"><i class="icon-copy fa fa-trash-o"></i></button>
                        </td>
                        <!-- edit modal -->
                        <div class="modal fade" :id="'edit'+data.id" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myMediumModalLabel">Edit Order</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form method="POST" @submit.prevent="submit('edit')">
                                        <div class="modal-body row">
                                            <div class="form-group col-md-12">
                                                <label> Product(s)</label>
                                                <multiselect v-model="fields.product" :options="products" placeholder="Select Product(s)" label="name" track-by="id" :multiple="false" @input="onChange"></multiselect>
                                                <div v-if="errors && errors.product_id" class="text-danger">{{ errors.product_id[0] }}</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button @click="beforeSubmit(data)" type="submit" class="btn btn-primary" :disabled="isDisabled">
                                                <div v-if="busyWriting"><i class="fa fa-refresh fa-spin fa-fw"></i> Saving</div>
                                                <div v-else> Save</div>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ./end edit modal -->
                    </tr>
                </tbody>
            </table>
            <!-- data pagination -->
            <pagination :data="orderdets" @pagination-change-page="getOrderDetails" :limit=3 align="right">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
            </pagination>
        </div>
        <!-- ./end data table -->
        
        <!-- add modal -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myMediumModalLabel">Add Order</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form method="POST" @submit.prevent="submit('add')">
                        <div class="modal-body row">
                            <div class="form-group col-md-12">
                                <label> Product(s)</label>
                                <multiselect v-model="fields.product" :options="products" placeholder="Select Product(s)" label="name" track-by="id" :multiple="true" @input="onChange"></multiselect>
                                <div v-if="errors && errors.product_id" class="text-danger">{{ errors.product_id[0] }}</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" :disabled="isDisabled">
                                <div v-if="busyWriting"><i class="fa fa-refresh fa-spin fa-fw"></i> Saving</div>
                                <div v-else> Save</div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ./end add modal -->
    </div>
</template>

<script>
    import FormMixin from '../shared/FormMixin';
    import DeleteMixin from '../shared/DeleteMixin';
    export default {
        mixins: [ FormMixin, DeleteMixin ],
        props: [ 'orderdetails' ],
        data() {
            return {
            'action': '/order-details/add',
            'action2': '/order-details/update',
            'text': 'Order Product added succesfully',
            'text2': 'Order Product updated succesfully',
            orderdets: [],
            busy: false,
            busy1: false,
            busyWriting:false,
            showModal: false,
            products:[],
            fields: {
                order_id: this.orderdetails.order_id,
                order_number: this.orderdetails.order_number,
                product:''
            }
            }
        },

        watch:{
                completed:	function (value) { 
                        this.getOrderDetails();
                        this.completed = false;
                    }
            },
        
        computed: {
            isDisabled(){
                return this.busy || this.busy1 || this.busyWriting;
            },
        },
        methods: {
            getOrderDetails: function(page = 1){
                this.busy = true;
                axios.get('/order-details/get/'+this.fields.order_id+'?page=' + page)
                .then(function(response){
                    this.busy = false;
                    this.orderdets = response.data;
                }.bind(this));
            },
            getProducts: function(){
                this.busy = true;
                axios.get('/products/all')
                .then(function(response){
                    this.busy = false;
                    this.products = response.data;
                }.bind(this));
            },
            beforeSubmit: function(order) {
                this.fields.id = order.id;
                this.fields.order_number = order.order_number;               
            },
            onChange(value) {
                this.fields.product = value;
            }
        },
        mounted() {
            this.fields.order_id = this.orderdetails.order_id;
            this.fields.order_number = this.orderdetails.order_number;
        },
        created: function() {
            this.getOrderDetails(),this.getProducts()
        }   
    }
</script>
<!--Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
