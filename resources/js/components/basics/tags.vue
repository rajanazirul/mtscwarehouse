<template>
<div>
    
<div class="card-body">
    <div class="">
        <div class="col-4 text-right">
        </div>
        
        <table class="table">
            <thead>
                <th>Date</th>
                <th>Purpose</th>
                <th>DO No.</th>
                <th>Inv No.</th>
                <th>Product</th>
                <th>Stock</th>
                <th>Status</th>
            </thead>
            <tr v-for="(tag, i) in tags" :key="i" v-if="tags.length"> 
                <td>{{tag.status}}</td>
                <td>{{tag.id}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#transactionModal">
                Change Status
                </button>
                <Button type="info" size="small" @click="showEditModal(tag, i)" >Edit</Button>
                </td>
            </tr>

        </table>
    </div>
</div>

<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-15">
                <input v-model="editData.status" placeholder="Edit tag name" >

                </div>
                    
                </div>
                </div>
                <div slot="footer">
                    <a  class="btn btn-sm btn-primary" @click="editTag()">{{isAdding ? 'Adding..' : 'Add tag'}}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<Modal
    v-model="editModal"
    title="Edit tag"
    :mask-closable="false"
    :closable="false"

    >
    <Input v-model="editData.status" placeholder="Edit tag name"  />

    <div slot="footer">
        <Button type="default" @click="editModal=false">Close</Button>
        <Button type="primary" @click="editTag" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Editing..' : 'Edit tag'}}</Button>
    </div>

</Modal>

</div>

</template>

<script>
export default {

    /*async created(){
        const res = await this.callApi('post', '/dmaddreturns/create_tag', {tagName: 'testtag'});
        console.log(res)
        if (res.status == 200){
            //console.log(res)
        }
    }*/
    data(){
        return {
            data : {
                status: ''
            },
            addModal: false,
            editModal:false,
            isAdding: false, 
            tags : [],
            editData : {
				status: ''
            },
            index : -1, 
        }
    },
    
    methods : {
        async addTag(){
            if(this.data.status.trim()=='') return this.e('Tag name is required')
            const res =await this.callApi('post', '/dmaddreturns/create_tag', this.data)
            if(res.status===201){
                this.s('Tag has been added successfully!')
            }
        },
        
        async editTag(){
            if(this.editData.status.trim()=='') return this.e('Tag name is required')
            const res = await this.callApi('post', '/dmaddreturns/create_tag', this.editData)
            if(res.status===200){
                this.tags[this.index].status = this.editData.status
                this.s('Tag has been edited successfully!')
                this.editModal = false
            }else{
                if(res.status==422){
                    if(res.data.errors.status){
                        this.e(res.data.errors.status[0])
                    }
                        
                }else{
                    this.swr()
                }
                    
            }
        },

        showEditModal(tag, index){
			let obj = {
				id : tag.id, 
				status : tag.status
			}
			this.editData = obj
			this.editModal = true
			this.index = index
		}

    },

    async created(){
        const res =await this.callApi('get', '/api/dmaddreturns/get_tag')
        if(res.status == 200){
            this.tags  = res.data
        }else{
            this.swr()
        }
    }



}
</script>