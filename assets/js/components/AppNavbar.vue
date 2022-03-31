<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a href="/">
        <img :src="logo" alt="">
      </a>
    </div>

    <div class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item" href="#">
          {{ $t("navbar.offers") }}
        </a>
        <a class="navbar-item" href="#">
          {{ $t("navbar.companies") }}
        </a>
        <a class="navbar-item" href="#">
          {{ $t("navbar.schools") }}
        </a>
      </div>
      <div class="navbar-end">
        <div class="navbar-item" @click="emitModalClick" v-if="!isAuthenticated">
          {{ $t("navbar.signup") }}
        </div>
        <div class="navbar-item is-relative" v-else>
          <div class="navbar-item__circle" @click="showDropdown = !showDropdown">
            <span>{{ initials }}</span>
          </div>
          <div class="dropdown" :class="{'is-active' : showDropdown}">
            <div class="dropdown-menu">
              <div class="dropdown-content">
                <a href="/account" class="dropdown-item">
                  tableau de bord
                </a>
                <div class="dropdown-item" @click="logout">
                  déco
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="navbar-item" href="#">
          {{ $t("navbar.languages") }}
        </a>
        <app-modal/>
      </div>
    </div>
  </nav>
</template>

<script>
import AppModal from "./AppModal";
import {mapGetters} from "vuex";

export default {
  name: "AppNavbar",
  components: {AppModal},
  data() {
    return {
      logo: require('/assets/images/common/logo.svg'),
      showModal: false,
      initials : '',
      showDropdown : false,
    }
  },
  computed: {
    ...mapGetters({
      isAuthenticated :'security/isAuthenticated',
      user: 'security/user',
      myDetails: 'users/user',
    }),
  },
  async created() {
   await this.$store.dispatch('security/tryLogin');
  },
 async mounted() {
    if(this.user) {
      await this.$store.dispatch('users/fetchUser', this.user);
      let firstname = this.myDetails.firstname.label.charAt(0);
      let lastname = this.myDetails.lastname.label.charAt(0);
      this.initials = firstname + lastname;
    }
  },
  methods: {
    emitModalClick() {
      this.emitter.emit('modal-state', {
        'modalState': true
      })
    },
    logout(){
      this.$store.dispatch('security/logout');
    },
  },
}
</script>

<style scoped lang="scss">
@import "styles/abstract/all";

.navbar {
  padding: 1.250rem 3.125rem 1.875rem;

  &-brand {
    margin-right: 3.125rem;

    img {
      width: 6.542vw;
    }
  }

  &-menu {
    font-size: 1.125rem;
    font-weight: 400;
  }

  &-item {
    cursor: pointer;
    text-transform: uppercase;

    &:not(:last-of-type) {
      margin-right: 2.5rem;

    }

    &:hover {
      background-color: transparent;
    }
    &.is-relative{
      .dropdown{
        position: absolute;
        top: 4.125rem;
      }
    }
    &__circle{
      align-items: center;
      background-color: lightgrey;
      border-radius: 50%;
      display: flex;
      height: 3.125rem;
      justify-content: center;
      width: 3.125rem;
      span {
        font-weight: 700;
        font-size: 1.5rem;
      }
    }

  }

  &-end {
    font-size: 1rem;
    font-weight: 400;
  }
}


</style>
