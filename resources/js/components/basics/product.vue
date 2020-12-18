<template>
<div>

  <div class="card-header">
    <div class="row">
       <div class="col-md-2">
          <input type="text" @keyup="searchUnit" placeholder="Search by Description" v-model="search" class="form-control form-control-sm">
        </div>
	</div>
  </div>
  <div class="card-header">
	<div class="row">
		<div class="col-md-2">
          <input type="text" @keyup="searchPart" placeholder="Search by Part Number" v-model="search1" class="form-control form-control-sm">
        </div>
	</div>
  </div>

<div class="card-body">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <th>Part No</th>
                <th>Description</th>
                <th>Stock</th>
            </thead>
            <tbody>
                <tr v-for="(tag, i) in orderId" :key="i" v-if="search != ''" >
                    <td>{{tag.name}}</td>
                    <td>{{tag.description}}</td>
					<td>{{tag.stock}}</td>
                </tr>
				<tr v-for="(tag, i) in orderPart" :key="i" v-if="search1 != ''" >
                    <td>{{tag.name}}</td>
                    <td>{{tag.description}}</td>
					<td>{{tag.stock}}</td>
                </tr>  
            </tbody>
        </table>
    </div>
</div>  
            <div>
                <pagination :data="laravelData" v-on:pagination-change-page="getResults"></pagination>
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
			laravelData: {},
			unitspart: [],
			search1: '',

        }
    },

    created(){
        this.getResults()
    },

    computed: {
        orderTags: function(){
            return _.orderBy(this.laravelData.data, 'updated_at').reverse()
        },
        orderId: function(){
            return _.orderBy(this.units, 'updated_at').reverse()
		},
		orderPart: function(){
            return _.orderBy(this.unitspart, 'updated_at').reverse()
        }
    },

    methods:{

        getResults(page) {
            if (typeof page === 'undefined') {
				page = 1;
			}

			// Using vue-resource as an example
			this.$http.get('/api/get_product?page=' + page)
				.then(response => {
					return response.json();
				}).then(data => {
					this.laravelData = data;
				});
        },

        searchUnit:function(){
          axios.get('/api/search_product?id='+this.search)
                .then((response)=>{
                this.units = response.data
          })
		},
		
		searchPart:function(){
          axios.get('/api/search_part?part='+this.search1)
                .then((response)=>{
                this.unitspart = response.data
          })
        },

    }

}
</script>