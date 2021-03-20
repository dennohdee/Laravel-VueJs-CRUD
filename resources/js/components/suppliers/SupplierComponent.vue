<template>
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h4 class="text-blue h4">Suppliers</h4>
            </div>
            <div class="pull-right">
                <!-- refresh data button -->
                <button @click.prevent="getSuppliers(page = 1)" class="btn btn-sm btn-round btn-outline-info" :disabled="isDisabled">
                    <div v-if="busy"><i class="fa fa-refresh fa-spin fa-fw"></i> </div>
                    <div v-else><i class="fa fa-refresh"></i> </div>
                </button>
                <!-- export buttons -->
                <span v-if="suppliers.total != 0">
                        <button @click.prevent="" class="btn btn-sm btn-round btn-outline-success" :disabled="isDisabled">
                            <div v-if="busy1"><i class="icon-copy fa fa-file-excel-o"></i> <i class="fa fa-refresh fa-spin fa-fw"></i></div>
                            <div v-else><i class="icon-copy fa fa-file-excel-o"></i> Excel</div>
                        </button>
                </span>
            </div>
        </div>
        <!-- data table -->
        <div class="table-responsive">
            <div v-if="suppliers.total == 0" class="p-3 border border-light text-center">
                Sorry! No supplier has been added yet.
            </div>
            <table v-else class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Products</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Products</th>
                        <th scope="col">Actions</th>

                    </tr>
                </tfoot>
                <div v-if="busy" class="text-center">Please wait. Loading...<i class="micon fa fa-refresh fa-spin fa-fw"></i></div>
                <tbody v-else>
                    <tr v-for="data in suppliers.data" :key="data.id">
                        <td>{{ data.id }}</td>
                        <td>{{ data.name }}</td>
                        <td>{{ data.supplier_products.length }}</td>
                        <td>
                            <button class="btn btn-sm btn-round btn-outline-* btn-warning" :data-target="'#edit'+data.id" data-toggle="modal" title="Edit"><i class="icon-copy fa fa-edit"></i></button>
                            <button @click.prevent="deleteItem('deletesupplierpath',data.id)" class="btn btn-sm btn-round btn-outline-* btn-danger" title="Delete"><i class="icon-copy fa fa-trash-o"></i></button>
                        </td>
                        <!-- edit modal -->
                        <div class="modal fade" :id="'edit'+data.id" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myMediumModalLabel">Edit Supplier</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form method="POST" @submit.prevent="submit('edit')">
                                        <div class="modal-body row">
                                            <div class="form-group col-md-12">
                                                <label>Name</label>
                                                <input class="form-control" name="name" v-model="data.name" type="text" placeholder="Enter Supplier Name" required>
                                                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
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
            <pagination :data="suppliers" @pagination-change-page="getSuppliers" :limit=3 align="right">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
            </pagination>
        </div>
        <!-- ./end data table -->
        
        <!-- add modal -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myMediumModalLabel">Add Supplier</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form method="POST" @submit.prevent="submit('add')">
                        <div class="modal-body row">
                            <div class="form-group col-md-12">
                                <label>Name</label>
                                <input class="form-control" name="name" v-model="fields.name" type="text" placeholder="Enter Supplier Name" required>
                                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
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
        data() {
            return {
            'action': '/suppliers/add',
            'action2': '/suppliers/update',
            'text': 'Supplier added succesfully',
            'text2': 'Supplier updated succesfully',
            suppliers: [],
            busy: false,
            busy1: false,
            busyWriting:false,
            showModal: false,
            }
        },

        watch:{
                completed:	function (value) { this.getSuppliers() }
            },
        
        computed: {
            isDisabled(){
                return this.busy || this.busy1 || this.busyWriting;
            },
        },
        methods: {
            getSuppliers: function(page = 1){
                this.busy = true;
                axios.get('/suppliers/get?page=' + page)
                .then(function(response){
                    this.busy = false;
                    this.suppliers = response.data;
                }.bind(this));
            },
            beforeSubmit: function(supplier) {
                this.fields.id = supplier.id;
                this.fields.name = supplier.name;            
            }
        },
        created: function() {
            this.getSuppliers()
        }   
    }
</script>
