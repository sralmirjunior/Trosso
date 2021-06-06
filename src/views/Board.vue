<template>
  <layout-page pageBackLink="/home" :pageTitle="board_name">
    <div full>
      <ion-grid class="">
        <ion-row class="ion-justify-content-center">
          <ion-col v-if="lists.length == 0" class="ion-text-center">
            <span>Nenhuma Lista</span>
          </ion-col>
        </ion-row>
        <div v-if="lists.length != 0">
          <List
            v-for="list in lists"
            :key="list.id"
            s
            :list="list"
            @card-added="loadLists"
            @card-updated="loadLists"
            @card-deleted="loadLists"
            @list-updated="loadLists"
            @list-deleted="loadLists"
          ></List>
        </div>
      </ion-grid>
    </div>
    <!-- Footer -->
    <template v-slot:footer>
      <ion-toolbar color="primary">
        <ion-grid>
          <ion-row class="ion-justify-content-evenly ion-align-items-center">
            <!-- Botão que chama a modal de adicionar lista -->
            <ion-button color="primary" fill="clear" @click="setOpen(true)">
              <ion-col size="10">
                <ion-label color="light">Adicionar lista </ion-label>
              </ion-col>
              <ion-col size="2">
                <ion-icon color="light" :icon="addCircleOutline"></ion-icon>
              </ion-col>
            </ion-button>
            <!-- Modal base -->
            <ion-modal :is-open="isOpenRef" @didDismiss="setOpen(false)">
              <layout-modal modalTitle="Adicionar Lista">
                <!-- Formulario de adicionar lista -->
                <form-add-List
                  :board_id="board_id"
                  @close="setOpen(false), loadLists()"
                />
              </layout-modal>
            </ion-modal>
          </ion-row>
        </ion-grid>
      </ion-toolbar>
    </template>
  </layout-page>
</template>

<script>
import {
  IonGrid,
  IonRow,
  IonCol,
  IonIcon,
  IonLabel,
  IonButton,
  IonToolbar,
  IonModal,
} from "@ionic/vue";
import { ref } from "vue";
import LayoutPage from "../components/LayoutPage";
import LayoutModal from "../components/LayoutModal";
import { addCircleOutline } from "ionicons/icons";
import FormAddList from "../components/FormAddList";
import { axiosHttp } from "../tools/axios.js";
import List from "../components/List.vue";
export default {
  components: {
    List,
    LayoutPage,
    LayoutModal,
    IonGrid,
    IonRow,
    IonCol,
    IonIcon,
    IonLabel,
    IonButton,
    IonToolbar,
    IonModal,
    FormAddList,
  },
  data() {
    return {
      lists: [],
      board_id: parseInt(this.$route.params.id),
      board_name: this.$route.params.name,
    };
  },
  ionViewWillEnter() {
    this.loadLists();
  },
  methods: {
    //Função para carregar os quadros da api
    loadLists() {
      axiosHttp
        .get("trosso.php", {
          params: { op: "getLists", board_id: this.board_id },
        })
        .then((resp) => {
          if (resp.data.sucesso) {
            this.lists = resp.data.lists;
            console.log(this.lists);
          }
        });
    },
  },
  setup() {
    //Variavel para checar se a modal está aberta
    const isOpenRef = ref(false);
    //Função para definir o estado da modal
    const setOpen = (state) => {
      return (isOpenRef.value = state);
    };

    return { isOpenRef, setOpen, addCircleOutline };
  },
};
</script>

<style scoped>
ion-grid span {
  font-size: 16px;
  line-height: 22px;
  color: var(--ion-color-medium);
  text-transform: uppercase;
  font-weight: 600;
}

.container ion-button {
  text-align: center center;
  margin: 30px 40px;
  min-height: 100px;
}

.container ion-button ion-label {
  margin: 0;
  text-transform: uppercase;
}

ion-footer ion-toolbar {
  border-radius: 12px 12px 0 0;
}

ion-footer ion-label {
  text-transform: uppercase;
  font-size: 16px;
}

ion-footer ion-icon {
  width: 32px;
  height: 30px;
  margin-right: 14px;
  margin-left: 0px;
}
</style>
