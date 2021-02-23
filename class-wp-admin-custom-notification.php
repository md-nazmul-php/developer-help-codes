<?php

// //=========== below are remove a gateway using class name=========

// add_filter( 'woocommerce_payment_gateways', 'payermax_remove_payment_gateways', 10, 1 );


//   function payermax_remove_payment_gateways( $load_gateways ) {

//     $remove_gateways = array( 
//         'WC_wcpayermax_indo_Gateway' // class name of my custom gateway.
//     );

//     foreach ( $load_gateways as $key => $value ) {

//         if ( in_array( $value, $remove_gateways ) ) {
//             unset( $load_gateways[ $key ] );
//         }
//     }

//     return $load_gateways;
// }