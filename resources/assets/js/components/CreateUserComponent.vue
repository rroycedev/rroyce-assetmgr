<template>

    <div>

        <div class="row" v-if="message != null && message != ''">
            <div :class="[(messagetype == 'success') ? 'alert alert-success  col-md-6 col-md-offset-6' : 'alert alert-danger  col-md-6 col-md-offset-6', 'alert alert-success  col-md-6 col-md-offset-6']" role="alert" v-if="message != ''">
                {{ message }}
            </div>
        </div>
        <div class="card create-user-card">
            <div class="card-header">Create User</div>
   
            <div class="card-body create-user-card-body">

                <div class="input-group input-group-sm mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm"><div class="user-create-edit-label">Username</div></span>
                    </div>
                    <input type="text" id="username" name="username" required class="form-control first-input-name" v-model="username" />
                </div>
                <div class="input-group input-group-sm mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm">
                            <div class="user-create-edit-label">First Name</div>
                        </span>
                    </div>
                    <input type="text" id="first_name" name="first_name" v-model="first_name" required class="form-control first-input-name" />
                </div>
                <div class="input-group input-group-sm mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm">
                            <div class="user-create-edit-label">Last Name</div>
                        </span>
                    </div>
                    <input type="text" id="last_name" name="last_name" v-model="last_name" required class="form-control first-input-name" />
                </div>
                <div class="input-group input-group-sm mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm">
                            <div class="user-create-edit-label">Password</div>
                        </span>
                    </div>
                    <input type="password" id="userpassword" name="userpassword" v-model="userpassword" onkeyup="check_password()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required class="form-control " />
                </div>
                <span id='message' style="line-height: 1.5;vetical-align:middle;"></span>
                <div class="input-group input-group-sm mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm">
                            <div class="user-create-edit-label">Confirm
                                <br>Password</div>
                        </span>
                    </div>
                    <input type="password" id="reentered_password" onkeyup="check_password()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required class="form-control " />
                </div>
                <div class="input-group input-group-sm mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm">
                            <div class="user-create-edit-label">Role</div>
                        </span>
                    </div>
                    <div style="max-height: 300px;overflow-y: auto;">
                        <ul style="margin: 0px;padding: 10px;" >
                            <li  v-for="group in groups" :key="group.id"  style="list-style: none;" >
                                <input type="checkbox" :name="'role_' + group.id" :id="'role_' + group.id" :value="group.id" v-model="roleIds">
                                <label :for="'role_' + group.id">{{group.name}}</label>
                            </li>
                        </ul>
                    </div>
                    <!--
                    <select class="form-select department-select" id="group_id" name="group_id" v-model="groupid">
                        <option v-for="group in groups" :key="group.user_role_id" :value="group.user_role_id">{{group.role_name}}</option>
                    </select>
                    -->
                </div>

                <div class="form-group" style="width: 175px;margin: auto;r">
                    <div>
                        <button class="btn btn-primary" id="create-user-btn" style="float: left;"  v-on:click="createUser">Create</button>
                        <div style="float: left;margin-left: 5px;">
                            <a href="/user" class="btn btn-primary">Back</a>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>
        </div>
 </div>
    
</template>

<script>
     export default {
    
       props: {
           groups: {
               type: Array
            },
            message: {
                type: String
            },
            messagetype: {
                type: String
            }
       },
       data: function() { 
        return {
           username: '',
           first_name: '',
           last_name: '',
           userpassword: '',
           groupid: 0,
           roleIds: [],
        }
       },       
      created: function()
        {
            console.log("create-user created");
        },

        mounted() {
            console.log("create-user Component mounted.");
            console.log(this);
        },
        methods: {
            toggleRole(roleId) {
                if (this._data.roleIds.includes(roleId)) {
                    var index = this._data.roleIds.indexOf(roleId);
                    if (index > -1) {
                        this._data.roleIds.splice(index, 1);
                    }
                }
                else {
                    this._data.roleIds.push(roleId);
                }

                this.$forceUpdate();

            },
            createUser(event) {
                if (this._isMounted) {
                    return;
                }                
                var usernameToCreate = this._props.username;
                
                self = this;

                axios.get('/user/' + usernameToDelete + "/doCreate")
                .then(function (response) {
                    console.log(response);

                    for(var i = self._props.users.length - 1; i >= 0; i--) {
                        if(self._props.users[i].userName === usernameToDelete) {
                            Vue.delete(self._props.users, i);
                            break;
                        }
                    }

                    $('#delete-modal').modal('hide');

                    this.message = "User has been created successfully";
                    this.messagetype = 'success';

                    self._update(self._render(), undefined);                   
                })
                .catch(function (error) {
                    $('#delete-modal').modal('hide');

                    alert(error);
                });


            }                   
        }
    }


</script>