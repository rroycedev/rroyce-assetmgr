<template>
  <!-- Sidebar menu-->
  <div>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">

      <ul class="app-menu" v-if="user != null">
            <li class="treeview" v-if="hasRole(user, 'Administrator') || hasRole(user, 'User Manager')"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-sign-in"></i><span class="app-menu__label">Authentication</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                 <li><a class="app-menu__item" href="/users"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a></li>
                 <li><a class="app-menu__item" href="/user/roles"><i class="app-menu__icon fa fa-object-group"></i><span class="app-menu__label">User Roles</span></a></li>
              </ul>
            </li>
      </ul>
    </aside>  
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object
        },
        groupname: {
            type: String
        }
    },
        methods: {
            hasRole(user, roleName) {
                var found = false;

                user.roles.forEach(function(role) {
                    if (role.name == roleName) {
                        found = true;
                    }
                });

                return found;
            }                   
        }    
    }
</script>

<style>

</style>
