<template>
<div >

<div>
    <td>
    <Button type="info" size="small" @click="showEditModal(tags, ids)" >FOR ADMIN</Button>
    </td>
</div>


<Modal
    v-model="editModal"
    title="Edit tag"
    :mask-closable="false"
    :closable="false"

    >
    <Input v-model="editData.status" placeholder="Edit ADMIN STATUS"  />

    <div slot="footer">
        <Button type="default" @click="editModal=false">Close</Button>
        <Button href="" type="primary" @click="editStatus" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Editing..' : 'FOR ADMIN'}}</Button>
    </div>

</Modal>
</div>

</template>

<script>
export default {

    data(){
        return {
            data : {
                status: ''
            },
            editModal:false,
            isAdding: false, 
            tags : [],
            editData : {
				status: ''
            },
            index : -1, 
            ids : 0,
        }
    },
    
    methods : {
        async editStatus(){
            if(this.editData.status.trim()=='') return this.e('Tag name is required')
            const res = await this.callApi('post', '/dmaddreturns/create_status', this.editData)
            if(res.status===200){
                this.tags.status = this.editData.status
                this.s('Tag has been edited successfully!')
                this.editModal = false
                window.location.reload()
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

        showEditModal(tags, index){
			let obj = {
				id : this.ids, 
				status : tags.status
			}
			this.editData = obj
			this.editModal = true
			this.index = index
		}

    },

    async created(){
        const res =await this.callApi('get', '/api/dmaddreturns/get_tag')
        this.ids = this.$route.params.pathMatch 
        if(res.status == 200){
            this.tags  = res.data
        }else{
            this.swr()
        }
    }

}
</script>