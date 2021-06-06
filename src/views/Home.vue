<template>
  <layout-page pageTitle="Trosso">
    <!-- Conteudo da Pagina Home -->
    <div class="container" full>
      <!-- Mensagem caso não exista quadros -->
      <span v-if="boards == null">sem quadros existentes</span>
      <!-- Lista dos quadros existentes -->
      <ion-button
        v-else
        :router-link="'/board/' + board.id + '/' + board.name"
        lines="none"
        color="secondary"
        v-for="board in boards"
        :key="board.id"
        expand="block"
      >
        <ion-label>{{ board.name }}</ion-label>
      </ion-button>
    </div>

    <!-- Footer -->
    <template v-slot:footer>
      <ion-toolbar color="primary">
        <ion-grid>
          <ion-row class="ion-justify-content-evenly ion-align-items-center">
            <!-- Botão que chama a modal de adicionar quadro -->
            <ion-button color="primary" fill="clear" @click="setOpen(true)">
              <ion-col size="10">
                <ion-label color="light">Adicionar quadro </ion-label>
              </ion-col>
              <ion-col size="2">
                <ion-icon color="light" :icon="addCircleOutline"></ion-icon>
              </ion-col>
            </ion-button>
            <!-- Modal base -->
            <ion-modal :is-open="isOpenRef" @didDismiss="setOpen(false)">
              <layout-modal modalTitle="Adicionar Quadro">
                <!-- Formulario de adicionar quadro -->
                <form-add-board @close="setOpen(false), loadBoards()" />
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
  //IonItem,
} from "@ionic/vue";
import { ref } from "vue";
import LayoutPage from "../components/LayoutPage";
import LayoutModal from "../components/LayoutModal";
import { addCircleOutline } from "ionicons/icons";
import FormAddBoard from "../components/FormAddBoard";
import { axiosHttp } from "../tools/axios.js";
export default {
  name: "Home",
  components: {
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
    FormAddBoard,
    // IonItem,
  },
  data() {
    return {
      boards: null,
    };
  },
  ionViewWillEnter() {
    this.loadBoards();
  },
  methods: {
    //loadBoards carrega os quadros vindos da api
    loadBoards() {
      axiosHttp
        .get("trosso.php", { params: { op: "getBoards" } })
        .then((resp) => {
          if (resp.data.sucesso) {
            this.boards = resp.data.boards;
            console.log(this.boards);
          }
        });
    },
  },
  setup() {
    //isOpenRef serve para setar o estado da modal, inicialmente falso
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
.container {
  text-align: center;
}

.container span {
  font-size: 16px;
  line-height: 22px;
  color: var(--ion-color-medium);
  text-transform: uppercase;
  font-weight: 600;
  transform: translateX(40%);
  position: absolute;
  display: block;
  margin-top: 55%;
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
