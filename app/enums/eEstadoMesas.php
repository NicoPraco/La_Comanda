<?php
    enum eEstadoMesas {
        case Abierta;
        case Cliente_Pagando;
        case Cliente_Comiendo;
        case Cliente_Esperando_Pedido;
        case Cerrada;
    }
