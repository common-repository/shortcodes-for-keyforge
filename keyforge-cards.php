<?php
/*
Plugin Name: Shortcodes For KeyForge
Description: A basic KeyForge Card Plugin
Author: Jim Mackin
Author URI: jsmackin.co.uk
Version: 0.0.1
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Shortcodes For KeyForge is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Shortcodes For KeyForge is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Shortcodes For KeyForge. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

defined('ABSPATH') or die('No script kiddies please!');
if (!class_exists('JSM_KeyForgeCards') ) {
    class JSM_KeyForgeCards
    {
        public static function activate()
        {
            global $wpdb;
            define('DIEONDBERROR', true);
            $table_name = $wpdb->prefix . "jsm_keyforge_cards";
            $sql = "CREATE TABLE $table_name (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    number mediumint(9) NOT NULL UNIQUE,
		                name VARCHAR(256) NOT NULL,
                    img_url varchar(256) DEFAULT '' NOT NULL,
		                PRIMARY KEY  (id)
		        );";

            include_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql);
            $handle = fopen(__DIR__."/keyforge_cards.jl", "r");
            if (!$handle) {
                return;
            }
            while (($line = fgets($handle)) !== false) {
                $js = json_decode($line, 1);
                $inserted = $wpdb->insert(
                    $table_name,
                    array(
                        'number' => $js['number'],
                    'name' => $js['name'],
                    'img_url' => $js['image_url'],
                    )
                );
            }
            fclose($handle);

        }
        public static function deactivate()
        {
            global $wpdb;
            $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}jsm_keyforge_cards");
        }
        public static function uninstall()
        {
        }
        public static function get_card_by_name($name)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . "jsm_keyforge_cards";

            return $wpdb->get_row(
                $wpdb->prepare("SELECT * FROM $table_name WHERE name LIKE %s", $name), ARRAY_A
            );
        }
        public static function get_card_by_id($number)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . "jsm_keyforge_cards";
            return $wpdb->get_row(
                $wpdb->prepare("SELECT * FROM $table_name WHERE number = %d", $number), ARRAY_A
            );
        }
        public static function get_deck($id)
        {
            $response = get_transient("JSM_KEYFORGE_DECK_".$id);
            if(empty($response)) {
                    $response = wp_remote_get('https://www.keyforgegame.com/api/decks/'.$id ."?links=cards", array('sslverify'   => false,));
                set_transient("JSM_KEYFORGE_DECK_".$id, $response, YEAR_IN_SECONDS);
            }
            $deckInfo = json_decode($response['body'], 1);
            $deck = array();
            $deck['name'] = $deckInfo['data']['name'];
            $cardDetails = array();
            foreach($deckInfo['_linked']["cards"] as $card){
                $cardDetails[$card['id']] = $card;
            }
            $deck['cards'] = array();
            foreach($deckInfo['data']['_links']['cards'] as $card){
                  $cInfo = $cardDetails[$card];
                if(empty($deck['cards'][$cInfo['house']])) {
                    $deck['cards'][$cInfo['house']] = array();
                }
                  $deck['cards'][$cInfo['house']][] = $cInfo;
            }
            return $deck;
        }
        public static function deck_shortcode($att)
        {
            if(empty($att['id'])) {
                return "";
            }
            $deckId = $att['id'];
            $deck = self::get_deck($deckId);
            include __DIR__."/tpls/deck.php";
            return $ret;
        }
        public static function card_image_shortcode($att)
        {
            $card = false;
            if(!empty($att['name'])) {
                $card = self::get_card_by_name($att['name']);
            }elseif(!empty($att['number'])) {
                $card = self::get_card_by_id($att['number']);
            }
            if(empty($card)) {
                return "";
            }
            if(empty($card['img_url'])) {
                return "";
            }
            $imageSrc = $card['img_url'];
            return "<img src='".$imageSrc."'/>";
        }
        public static function card_shortcode($att)
        {
            $card = false;
            if(!empty($att['name'])) {
                $card = self::get_card_by_name($att['name']);
            }elseif(!empty($att['number'])) {
                $card = self::get_card_by_id($att['number']);
            }
            if(empty($card)) {
                return "";
            }
            if(empty($card['img_url'])) {
                return "";
            }
            include __DIR__."/tpls/card.php";
            return $ret;
        }
    }
    add_shortcode("keyforge-card", array('JSM_KeyForgeCards', 'card_shortcode' ));
    add_shortcode("keyforge-card-image", array('JSM_KeyForgeCards', 'card_image_shortcode' ));
    add_shortcode("keyforge-deck", array('JSM_KeyForgeCards', 'deck_shortcode' ));
    register_activation_hook(__FILE__, array( 'JSM_KeyForgeCards', 'activate' ));
    register_deactivation_hook(__FILE__, array( 'JSM_KeyForgeCards', 'deactivate' ));
    register_uninstall_hook(__FILE__, array( 'JSM_KeyForgeCards', 'uninstall' ));

}
