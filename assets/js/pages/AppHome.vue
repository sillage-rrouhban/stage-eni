<template>
  <div class="home">
    <app-loader v-if="showLoader"/>
    <app-navbar/>
    <div class="columns home-header">
      <div class="column is-two-thirds home-header__intro">
        <h1 class="is-size-1 ">Lorem ipsum dolor sit amet</h1>
        <p>Lorem ipsum dolor sit amet. Ea voluptas enim qui excepturi similique ad deserunt
          nobis et consequatur omnis
          quo
          facere quasi. Deserunt dolorem aut autem Quis et itaque temporibus ea architecto vero. Et aspernatur dolores a
          ullam
          nisi non reprehenderit ipsum qui voluptatum laudantium est molestiae odio et minus repudiandae. Aut debitis
          tempora est
          maiores adipisci ut quia asperiores id neque aliquid. </p>
      </div>
      <div class="column is-one-third home-header__buttons">
        <div class="buttons">
          <button class="button wide-button">{{$t("home.offers")}}</button>
        </div>
        <div class="buttons">
          <button class="button wide-button">{{$t("home.recruiters")}}</button>
        </div>
      </div>
    </div>

    <div class="columns is-centered home-header__counters">
      <div class="column is-one-third has-text-centered">
        <h2 class="is-size-2" v-if="users && users.length > 0">{{ studentsCount }}</h2>
        <img :src="student">
        <h3 class="is-size-3 is-uppercase">{{ $t("home.students") }}</h3>

      </div>
      <div class="column is-one-third has-text-centered">
        <h2 class="is-size-2" v-if="users && users.length > 0">{{ companiesCount }}</h2>
        <img :src="company">
        <h3 class="is-size-3 is-uppercase">{{ $t("home.companies") }}</h3>
      </div>
    </div>
    <app-footer/>
  </div>
</template>

<script>
import AppNavbar from "../components/AppNavbar";
import AppFooter from "../components/AppFooter";
import AppLoader from "../components/AppLoader";
import {mapGetters} from 'vuex';



export default {
  name: "AppHome",
  components: {AppLoader, AppFooter, AppNavbar},
  data() {
    return {
      student: require('/assets/images/home/student.svg'),
      company: require('/assets/images/home/company.svg'),
      showLoader: false,
    }
  },
  computed:{
    ...mapGetters({
      users: 'users/users'
    }),
    studentsCount(){
      return this.users.filter(user => user.type.id ===1).length;
    },
    companiesCount(){
      return this.users.filter(user => user.type.id === 2).length;
    }
  },
  /*
    setup(){
     const store = useStore()
      const users = computed(()=> store.state.users.users)
      const usersGetter = computed(()=> store.getters['users/users'])
      store.dispatch('users/fetchUsers')
      return{
       users,
        usersGetter
      }
    },

   */

  async mounted() {
    await this.fetchUsers();
  },
  methods: {
    async fetchUsers(){
      this.showLoader = true;
      try {
        await this.$store.dispatch('users/fetchUsers');
      } catch (error) {
        console.error(error)
      } finally {
        this.showLoader = false;
      }
    }


    /*
    Appel axios.get => récup url api pour la partie concercnée
fetchStudents() {
      /*
      add asynch devant methode
      récup le call api avec .then pour la promesse
      donc promesses avec response qu'on va link à users
      On rajoute un loader pour aller récup les datas
      Une fois les datas récup, on rajoute finally => inqique la fin du loading


      // let response = await this.studentApi();
      //  this.users = response.data;
      this.showLoader = truis.showLoader = false;e;
      this.userApiGet().then((response)=>{
        this.users = response.data;
      }).catch((error) => {
      })
          .finally(()=>{
            th
          });

    }
  }
  */

  }
}
</script>

<style scoped lang="scss">
@import "styles/abstract/all";

.home-header {
  align-items: center;
  background: lightgrey;
  padding-bottom: 8.875rem;
  padding-top: 8.875rem;
  &__intro {
    padding-left: 10%;
    h1 {
      font-family: $title-family;
      margin-bottom: 1.250rem;
    }
    p {
      font-size: 1.5rem;
      line-height: 2.188rem;
      font-weight: 300;
      width: 41.667vw;
    }
  }

  &__buttons {
    .wide-button {
      &:first-of-type {
        margin-bottom: 2.5rem;
      }
    }
  }
  &__counters{
    padding: 3.125em;
    img{
      margin:1.2rem 0;
    }
  }
}

</style>
