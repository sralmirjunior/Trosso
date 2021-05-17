<template>
  <layout-page pageTitle="Trosso">
    <!-- Conteudo da Pagina Home -->
    <div id="container">
      <!-- Mensagem caso não exista quadros -->
      <span v-if="quadros == null">sem quadros existentes</span>
      <!-- Lista dos quadros existentes -->
      <ion-item v-else v-for="quadro in quadros" :key="quadro.id">
        <ion-label>{{ quadro.nome }}</ion-label>
      </ion-item>
    </div>
    <!-- Footer -->
    <template v-slot:footer>
      <ion-toolbar color="primary">
        <ion-grid>
          <ion-row class="ion-justify-content-evenly ion-align-items-center">
            <!-- Botão que chama a modal de adicionar quadros -->
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
                <!-- Formulario de adicionar quadros -->
                <form-add-board />
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
  IonItem,
} from "@ionic/vue";
import { ref } from "vue";
import LayoutPage from "../components/LayoutPage";
import LayoutModal from "../components/LayoutModal";
import { addCircleOutline } from "ionicons/icons";
import FormAddBoard from "../components/FormAddBoard.vue";

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
    IonItem,
  },
  setup() {
    const isOpenRef = ref(false);
    const setOpen = (state) => {
      return (isOpenRef.value = state);
    };
    return { isOpenRef, setOpen, addCircleOutline };
  },
  created() {
    this.quadros = [
      {
        id: 1,
        nome: "quadro teste 01",
      },
      {
        id: 2,
        nome: "quadro teste 02",
      },
    ];
  },
};
</script>

<style scoped>
#container {
  text-align: center;
  position: absolute;
  left: 0;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
}

#container span {
  font-size: 16px;
  line-height: 22px;
  color: var(--ion-color-medium);
  margin: 0;
  text-transform: uppercase;
  font-weight: 600;
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
