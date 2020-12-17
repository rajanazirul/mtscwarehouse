<template>
<div>
<pagination :data="laravelData" v-on:pagination-change-page="getResults"></pagination>
</div>
</template>

<script>
export default {

    data() {
		return {
			// Our data object that holds the Laravel paginator data
			laravelData: {},
		}
	},

	created() {
		// Fetch initial results
		this.getResults();
	},

	methods: {
		// Our method to GET results from a Laravel endpoint
		getResults(page) {
			if (typeof page === 'undefined') {
				page = 1;
			}

			// Using vue-resource as an example
			this.$http.get('api/dmaddreturns/get_tag?page=' + page)
				.then(response => {
					return response.json();
				}).then(data => {
					this.laravelData = data;
				});
		}
	}

}
</script>