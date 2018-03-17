<template>
  <!-- Sidebar menu-->
  <div>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">

      <ul class="app-menu" v-if="username != ''">
             <li><a class="app-menu__item" href="/users"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a></li>
             <!--
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Users</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-circle-o"></i> Create</a></li>
                <li><a class="treeview-item" href="http://fontawesome.io/icons/" target="_blank"><i class="icon fa fa-circle-o"></i> Font Icons</a></li>
                <li><a class="treeview-item" href="ui-cards.html"><i class="icon fa fa-circle-o"></i> Cards</a></li>
                <li><a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o"></i> Widgets</a></li>
              </ul>
            </li>
            -->
      </ul>
    </aside>  
    </div>
</template>

<script>
export default {
    props: {
        username: {
            type: String
        },
        groupname: {
            type: String
        }
    }
}
</script>

<style>

</style>
