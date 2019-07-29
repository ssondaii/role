<template>
    <div class="role-api-calling">
        <div class="add-edit-role">
        	<div class="add-role">
				<form>
					<table class="add-edit-table">
						<tr><th colspan="2" style="background-color: orange;">Add Role</th></tr>
						<tr>
							<td>Role Name</td>
							<td><input type="text" v-model="role.name"></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><input type="text" v-model="role.des"></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Create New Role" @click.prevent="createNewRole()">
							</td>
						</tr>
					</table>
				</form>
			</div>
			<br>
			<div class="edit-role">
				<form>
					<table class="add-edit-table">
						<tr><th colspan="2" style="background-color: violet;">Update Role</th></tr>
						<tr>
							<td>Role Name</td>
							<td><input type="text" v-model="roleUpdate.name"></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><input type="text" v-model="roleUpdate.des"></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Update Role" @click.prevent="editRole(roleUpdate)">
							</td>
						</tr>
					</table>
				</form>
			</div>
        </div>
        <div class="list-role">
        	<table>
        		<thead>
        			<tr>
        				<th>ID</th>
        				<th>Name Role</th>
        				<th>Description</th>
        				<th colspan="2">Action</th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr v-for="rol in listRole">
        				<td>{{rol.id}}</td>
        				<td>{{rol.name}}</td>
        				<td>{{rol.description}}</td>
        				<td><button @click="updateRole(rol)">Edit</button></td>
        				<td><button @click="deleteRole(rol)">Delete</button></td>
        			</tr>
        		</tbody>
        	</table>
        </div>
    </div>
</template>

<script>
    export default {
		data(){
			return{
				role:{
    				name: '',
    				des: ''
    			},
    			roleUpdate:{
    				id: 0,
    				name:'',
    				des: ''
    			},
    			listRole: []
			}
		},
		created(){
			this.getListRole();
		},
    	methods:{
    		createNewRole(){
    			axios.post('/roles',{name: this.role.name, des: this.role.des})
    			.then(response=>{
    				console.log(response.data.result),
    				this.getListRole()
    			})
    		},
    		getListRole(){
    			axios.get('/roles')
    			.then(response=>{
    				this.listRole = response.data
    			})
    		},
    		deleteRole(rol){
    			axios.delete('/roles/'+rol.id)
    			.then(response=>{
    				console.log(response.data.result),
    				this.getListRole()
    			})
    		},
    		updateRole(rol){
    			this.roleUpdate.id = rol.id,
    			this.roleUpdate.name = rol.name,
    			this.roleUpdate.des = rol.description
    		},
    		editRole(roleUpdate){
    			axios.put('/roles/' + roleUpdate.id, {name: roleUpdate.name, des: roleUpdate.des})
    			.then(response => {
                    console.log(response.data.result),
                    this.getListRole()
                })
    		}
    	}
    };
</script>

<style lang="scss" scoped>
	.role-api-calling {  
	  display: -ms-flexbox; 
	  display: flex;
	  -ms-flex-wrap: wrap;
	  flex-wrap: wrap;
	}

	.add-edit-role {
	  -ms-flex: 25%; 
	  flex: 25%;
	  background-color: #f1f1f1;
	  padding: 20px;
	}
	.list-role {   
	  -ms-flex: 75%;
	  flex: 75%;
	  background-color: white;
	  padding: 20px;
	}
	table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	tr:nth-child(even) {
	  background-color: #dddddd;
	}

	th{
	  background-color:  green;
	  color:  white;
	  text-align: center;
	}
</style>