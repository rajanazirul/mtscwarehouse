<template>

<div class="card-body">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <th>DM</th>
                <th>Date</th>
                <th>Status</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="(tag, i) in orderTags" :key="i" v-if="tags.length" >
                    <td>DM/20/00{{tag.id}}</td>
                    <td>{{tag.finalized_at}}</td>
                    <td v-if="tag.status == null" style="font-weight:bold;">PENDING ADMIN</td>
                    <td v-if="tag.status !== null">{{tag.status}}</td>
                </tr> 
            </tbody>
        </table>
    </div>
</div>  

</template>

<script>
export default {

    data(){
        return {

            tags : [],

        }
    },

    computed: {
        orderTags: function(){
            return _.orderBy(this.tags, 'id').reverse()
        }
    },

    async created(){
        const res =await this.callApi('get', '/api/dmform/getdeduct')
        if(res.status == 200){
            this.tags  = res.data
        }else{
            this.swr()
        }
    }

}
</script>