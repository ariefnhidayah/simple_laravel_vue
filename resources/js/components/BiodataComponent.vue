<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            	<div class="card-header">
            		List Biodata
            	</div>
            	<div class="card-body">
                    <button class="btn btn-primary mb-3" @click="showmodal">Tambah</button>
            		<table class="table table-stripped table-hover">
            			<thead class="thead-dark">
	            			<tr>
	            				<th>#</th>
	            				<th>Nama</th>
	            				<th>Alamat</th>
	            				<th>Pekerjaan</th>
	            				<th>Opsi</th>
	            			</tr>
            			</thead>
            			<tbody v-if="biodata.length > 0">
            				<tr v-for="bio,index in biodata" :key="index">
            					<td>{{ index + 1 }}</td>
            					<td>{{ bio.nama }}</td>
            					<td>{{ bio.alamat }}</td>
            					<td>{{ bio.pekerjaan }}</td>
            					<td>
            						<button class="btn btn-primary" @click="showBiodata(bio)">Ubah</button>
            						<button class="btn btn-danger" @click="deleteBiodata(bio)">Hapus</button>
            					</td>
            				</tr>
            			</tbody>
            			<tbody v-else>
            				<tr>
            					<td colspan="5" style="text-align: center;">Data kosong</td>
            				</tr>
            			</tbody>
            		</table>
            	</div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	        <div class="modal-header">
	            <h5 class="modal-title" id="exampleModalLabel">Biodata Form</h5>
	             <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="resetModal()">
	             	<span aria-hidden="true">&times;</span>
	             </button>
	        </div>
	        <div class="modal-body">
	        	<div v-if="errors.length > 0" class="alert alert-danger">
	        		<ul>
	        			<li v-for="error, index in errors" :key="index">{{ error }}</li>
	        		</ul>
	        	</div>
	            <div class="form-group">
	                <label>Nama</label>
	                <input type="text" name="nama" id="" class="form-control" v-model="addBiodata.nama">
	             </div>
	            <div class="form-group">
	                <label>Alamat</label>
	                <input type="text" name="alamat" id="" class="form-control" v-model="addBiodata.alamat">
	             </div>
	            <div class="form-group">
	                <label>Pekerjaan</label>
	                <input type="text" name="pekerjaan" id="" class="form-control" v-model="addBiodata.pekerjaan">
	             </div>
	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="resetModal()">Tutup</button>
	            <button type="button" class="btn btn-primary" @click="createBiodata()">{{ modalButton }}</button>
	        </div>
	        </div>
	    </div>
	</div>
</div>
</template>

<script>
	export default {
		data() {
			return {
				biodata: [],
				addBiodata: {
					nama: '',
					alamat: '',
					pekerjaan: '',
					id: ''
				},
				errors: [],
				edit: false,
				modalButton: 'Tambah'
			}
		},
		methods: {
			showmodal() {
				$('#modal-form').modal('show');
			},
			getBiodata() {
				axios.get('/biodatavue').then((response) => {
					this.biodata = response.data.data;
				});
			},
			createBiodata() {
				if(this.edit === true) {
					axios.put('/biodatavue/' + this.addBiodata.id, {
						nama: this.addBiodata.nama,
						alamat: this.addBiodata.alamat,
						pekerjaan: this.addBiodata.pekerjaan
					}).then((response) => {
						this.getBiodata();
						$('#modal-form').modal('hide');
						this.resetModal();
					}).catch((error) => {
						if(error.response.data.errors.nama) {
							this.errors.push(error.response.data.errors.nama[0]);
						}
						if(error.response.data.errors.alamat) {
							this.errors.push(error.response.data.errors.alamat[0]);
						}
						if(error.response.data.errors.pekerjaan) {
							this.errors.push(error.response.data.errors.pekerjaan[0]);
						}
					});
				} else {
					axios.post('/biodatavue', {
						nama: this.addBiodata.nama,
						alamat: this.addBiodata.alamat,
						pekerjaan: this.addBiodata.pekerjaan
					}).then((response) => {
						this.getBiodata();
						$('#modal-form').modal('hide');
						this.resetModal();
					}).catch((error) => {
						if(error.response.data.errors.nama) {
							this.errors.push(error.response.data.errors.nama[0]);
						}
						if(error.response.data.errors.alamat) {
							this.errors.push(error.response.data.errors.alamat[0]);
						}
						if(error.response.data.errors.pekerjaan) {
							this.errors.push(error.response.data.errors.pekerjaan[0]);
						}
					});
				}
			},
			resetModal() {
				this.addBiodata.nama = '';
				this.addBiodata.alamat = '';
				this.addBiodata.pekerjaan = '';
				this.errors = [];
				this.modalButton = 'Tambah';
			},
			showBiodata(biodata) {
				this.modalButton = 'Ubah';
				this.edit = true;
				this.addBiodata.id = biodata.id;
				this.addBiodata.nama = biodata.nama;
				this.addBiodata.alamat = biodata.alamat;
				this.addBiodata.pekerjaan = biodata.pekerjaan;
				this.showmodal();
			},
			deleteBiodata(biodata) {
				if(confirm('Apakah ingin dihapus')) {
					axios.delete('/biodatavue/' + biodata.id).then((response) => {
						this.getBiodata();
					}).catch((error) => {
						console.log(error);
					});
				} else {
					return false;
				}
			}
		},
		mounted() {
			this.getBiodata();
		}
	}
</script>

<style>
	
</style>