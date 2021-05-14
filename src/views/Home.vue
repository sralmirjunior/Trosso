<template>
  <layout-base-page pageTitle="Trosso">
    <!-- Conteudo da Pagina Home -->
    <div id="container">
      <span>sem quadros existentes</span>
    </div>
    <!-- Footer -->
    <template v-slot:footer>
      <ion-toolbar color="primary">
        <ion-grid>
          <ion-row class="ion-justify-content-evenly ion-align-items-center">
            <!-- Botão de adicionar quadro -->
            <ion-button color="primary" fill="clear" @click="openModal">
              <ion-col size="10">
                <ion-label color="light">Adicionar quadro </ion-label>
              </ion-col>
              <ion-col size="2">
                <ion-icon color="light" :icon="addCircleOutline"></ion-icon>
              </ion-col>
            </ion-button>
          </ion-row>
        </ion-grid>
      </ion-toolbar>
    </template>
  </layout-base-page>
</template>

<script>
import LayoutBasePage from "../components/LayoutBasePage.vue";

import {
  IonGrid,
  IonRow,
  IonCol,
  modalController,
  IonIcon,
  IonLabel,
  IonButton,
  IonToolbar,
} from "@ionic/vue";

import ModalAddBoard from "../components/ModalAddBoard";

import { addCircleOutline } from "ionicons/icons";

export default {
  name: "Home",
  components: {
    LayoutBasePage,
    IonGrid,
    IonRow,
    IonCol,
    IonIcon,
    IonLabel,
    IonButton,
    IonToolbar,
  },
  methods: {
    async openModal() {
      const modal = await modalController.create({
        component: ModalAddBoard,
      });
      return modal.present();
    },
  },
  setup() {
    return {
      addCircleOutline,
    };
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
