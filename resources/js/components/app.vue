<template>
<div>

  <div class="card-header">
    <div class="row">
       <div class="col-md-2">
          <input type="text" @keyup="searchUnit" placeholder="Search" v-model="search" class="form-control form-control-sm">
        </div>
    </div>
  </div>

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
                <tr v-for="(tag, i) in orderTags" :key="i" v-if="units.length == 0" >
                    <td>DM/20/D00{{tag.id}}</td>
                    <td>{{tag.finalized_at}}</td>
                    <td v-if="tag.status == null" style="font-weight:bold;">PENDING ADMIN</td>
                    
                    <td v-if="tag.status !== null">{{tag.status}}</td>
                    <td class="td-actions text-right">
                        <a v-bind:href="'dmform/'+ tag.id" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver Receipt">
                            <i class="tim-icons icon-zoom-split"></i>
                        </a>
                    </td>
                </tr>
                <tr v-for="(tag, i) in orderId" :key="i" v-if="units.length > 0" >
                    <td>DM/20/D00{{tag.id}}</td>
                    <td>{{tag.finalized_at}}</td>
                    <td v-if="tag.status == null" style="font-weight:bold;">PENDING ADMIN</td>
                    
                    <td v-if="tag.status !== null">{{tag.status}}</td>
                    <td class="td-actions text-right">
                        <a v-bind:href="'dmform/'+ tag.id" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver Receipt">
                            <i class="tim-icons icon-zoom-split"></i>
                        </a>
                    </td>
                </tr> 
            </tbody>
            <!--<pagination :data="tags" @pagination-change-page="getResults"></pagination>
            <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ tags.current_page}}asdad
                    </nav>
            </div>-->
        </table>
    </div>
</div>  

</div>
</template>

<script>
export default {

    data(){
        return {
            units: [],
            search: '',
            tags : [],

        }
    },

    computed: {
        orderTags: function(){
            return _.orderBy(this.tags.data, 'finalized_at').reverse()
        },
        orderId: function(){
            return _.orderBy(this.units, 'finalized_at').reverse()
        }
    },

    methods:{

        /*getResults(page = 1) {
              axios.get('/api/dmform/getdeduct?page=' + page)
                .then(response => {
                  this.tags = response.data;
              });
        },*/

        searchUnit:_.debounce(function(){
          axios.get('/api/search_dmform?id='+this.search)
                .then((response)=>{
                this.units = response.data
          })
        }),

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