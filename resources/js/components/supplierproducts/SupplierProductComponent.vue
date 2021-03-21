<template>
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h4 class="text-blue h4">Product for Supplier {{ fields.name }}</h4>
            </div>
            <div class="pull-right">
                <!-- refresh data button -->
                <button @click.prevent="getSupplierProducts(page = 1)" class="btn btn-sm btn-round btn-outline-info" :disabled="isDisabled">
                    <div v-if="busy"><i class="fa fa-refresh fa-spin fa-fw"></i> </div>
                    <div v-else><i class="fa fa-refresh"></i> </div>
                </button>
                <!-- export buttons -->
                <span v-if="supplierproducts.total != 0">
                        <!-- <button @click.prevent="" class="btn btn-sm btn-round btn-outline-success" :disabled="isDisabled">
                            <div v-if="busy1"><i class="icon-copy fa fa-file-excel-o"></i> <i class="fa fa-refresh fa-spin fa-fw"></i></div>
                            <div v-else><i class="icon-copy fa fa-file-excel-o"></i> Excel</div>
                        </button> -->
                </span>
            </div>
        </div>
        <!-- data table -->
        <div class="table-responsive">
            <div v-if="supplierproducts.total == 0" class="p-3 border border-light text-center">
                Sorry! No product has been added yet.
            </div>
            <table v-else class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Products</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Products</th>
                        <th scope="col">Actions</th>

                    </tr>
                </tfoot>
                <div v-if="busy" class="text-center">Please wait. Loading...<i class="micon fa fa-refresh fa-spin fa-fw"></i></div>
                <tbody v-else>
                    <tr v-for="data in supplierproducts.data" :key="data.id">
                        <td>{{ data.id }}</td>
                        <td>{{ data.supplierproduct_product.name }}</td>
                        <td>
                            <button @click.prevent="deleteItem('deletesupplierproductspath',data.id)" class="btn btn-sm btn-round btn-outline-* btn-danger" title="Delete"><i class="icon-copy fa fa-trash-o"></i></button>
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
            <pagination :data="supplierproducts" @pagination-change-page="getSupplierProducts" :limit=3 align="right">
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
                        <h4 class="modal-title" id="myMediumModalLabel">Assign products</h4>
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
        props: [ 'supplierdetails' ],
        data() {
            return {
            'action': '/supplier-products/add',
            'action2': '/supplier-products/update',
            'text': 'Product added succesfully',
            'text2': 'Product updated succesfully',
            supplierproducts: [],
            busy: false,
            busy1: false,
            busyWriting:false,
            showModal: false,
            products:[],
            fields: {
                supplier_id: this.supplierdetails.supplier_id,
                name: this.supplierdetails.name,
                product:''
            }
            }
        },

        watch:{
                completed:	function (value) { 
                        this.getSupplierProducts();
                        this.completed = false;
                    }
            },
        
        computed: {
            isDisabled(){
                return this.busy || this.busy1 || this.busyWriting;
            },
        },
        methods: {
            getSupplierProducts: function(page = 1){
                this.busy = true;
                axios.get('/supplier-products/get/'+this.fields.supplier_id+'?page=' + page)
                .then(function(response){
                    this.busy = false;
                    this.supplierproducts = response.data;
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
                this.fields.name = order.name;               
            },
            onChange(value) {
                this.fields.product = value;
            }
        },
        mounted() {
            this.fields.supplier_id = this.orderdetails.supplier_id;
            this.fields.name = this.orderdetails.name;
        },
        created: function() {
            this.getSupplierProducts(),this.getProducts()
        }   
    }
</script>
<!--Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
