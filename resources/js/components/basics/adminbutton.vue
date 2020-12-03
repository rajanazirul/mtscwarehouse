<template>
<div >
<tr v-for="(tag, i) in tags" :key="i" v-if="tags.length">
<Button type="info" size="small" @click="showEditModal(tag, i)" >Edit</Button>
</tr>
<Modal
    v-model="editModal"
    title="Edit tag"
    :mask-closable="false"
    :closable="false"

    >
    <Input v-model="editData.status" placeholder="Edit tag name"  />

    <div slot="footer">
        <Button type="default" @click="editModal=false">Close</Button>
        <Button href="" type="primary" @click="editTag" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Editing..' : 'Edit tag'}}</Button>
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