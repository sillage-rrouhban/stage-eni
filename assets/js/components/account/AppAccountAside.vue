<template>
  <aside class="menu">
    <ul class="menu-list">
      <li :class="{'has-text-weight-bold': panelSelected === 1}"
          @click="emitNavigationClick(1)">
        {{$t("account.aside.information")}}
      </li>
      <li :class="{'has-text-weight-bold': panelSelected === 2}"
          @click="emitNavigationClick(2)">
        {{$t("account.aside.studies")}}
      </li>
      <li :class="{'has-text-weight-bold': panelSelected === 3}"
          @click="emitNavigationClick(3)">
        {{$t("account.aside.online-presence")}}
      </li>
      <li :class="{'has-text-weight-bold': panelSelected === 4}"
          @click="emitNavigationClick(4)">
        {{$t("account.aside.setting")}}
      </li>
    </ul>
  </aside>

</template>

<script>
export default {
  name: "AppAccountAside",
  data(){
    return{
      panelSelected: 1,
    }
  },
  methods: {
    emitNavigationClick(id){
      this.panelSelected = id;
      this.emitter.emit('navigate-to',{
        'panelSelected': id
      })
    }
  }
}

</script>

<style scoped lang="scss">
.menu{
  &-list{
    li{
      cursor: pointer;
    }
  }
}
</style>