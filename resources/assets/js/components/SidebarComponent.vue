<template>
  <!-- Sidebar menu-->
  <div>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">

      <ul class="app-menu" v-if="user != null">
            <li class="treeview" v-if="user.user_role_id == 1"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-sign-in"></i><span class="app-menu__label">Authentication</span><i class="treeview-indicator fa fa-angle-right"></i></a>
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
    }
}
</script>

<style>

</style>
