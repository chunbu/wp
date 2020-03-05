<?php
define('MB_PERSONALIZED_URL', plugin_dir_url(__FILE__));
class MB_Personalized{
    function __construct(){
        //$this->load();
    }
    function load(){

        add_action('woocommerce_before_add_to_cart_button', array( $this,'get_data_json_no1'));

        //do_action('woocommerce_before_add_to_cart_button', array( $this,'get_data_json_no1'));

    }
    function get_data_json_no1() {

        $string1 = file_get_contents("https://gist.githubusercontent.com/TruongTuyen/d8c066d61c71da1f992713bc2e02fe2c/raw/4bc27e6e6e6df2bf51955c26b0fc10d038bbaad7/persionalized-configs.json");
        $json = json_decode($string1, true);
        foreach ($json as $key => $value) {
            ?>
            <div style="width:300px">
             <?php if ($value['field_type']==='text'||$value['field_type']==='number') { ?>
                    <div class="<?=$value['title']?>">
                        <label for=""><?=$value['title']?></label>:<br>
                        <input type="<?=$value['field_type']?>"class="<?=$value['field_name']?>" id="<?=$value['field_name']?>" name="<?=$value['field_name']?>" placeholder="<?=$value['title']?>" style="width:300px">
                    </div>
            <?php } elseif($value['field_type']==='textarea'){ ?>
                <div class="<?=$value['title']?>">
                    <label for=""><?=$value['title']?></label>:<br>
                    <textarea class="<?=$value['field_name']?>" id="<?=$value['field_name']?>" name="<?=$value['field_name']?>"></textarea>
                </div>
            <?php } elseif($value['field_type']==='checkbox'){ ?>
                <div class="<?=$value['title']?>" style="text-align:justify">
                <label for=""><?=$value['title']?></label>:<br>
                <?php foreach($value['configs']['settings']['options'] as $key => $val){
                    ?>
                        <input type="<?=$value['field_type']?>"class="<?=$value['field_name']?>" id="<?=$value['field_name']?>" name="<?=$value['field_name']?>" placeholder="<?=$value['title']?>">
                        <span><?=$val?></span>
                    <?php
                    }
                ?>
                </div>
            <?php } elseif($value['field_type']==='radio'){ ?>
                <div class="<?=$value['title']?>">
                    <label for=""><?=$value['title']?></label>:<br>
                    <div style="text-align:justify">
                        <?php foreach($value['configs']['settings']['options'] as $key => $val){
                            ?>
                            <input type="<?=$value['field_type']?>"class="<?=$value['field_name']?>" id="<?=$value['field_name']?>" name="<?=$value['field_name']?>" placeholder="<?=$value['title']?>">
                            <span><?=$val?></span>
                        <?php
                        }
                       ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="<?=$value['title']?>">
                    <label for=""><?=$value['title']?></label>:<br>
                    <select id="cars" style="width:300px">
                        <?php foreach($value['configs']['settings']['options'] as $key => $val){
                            ?>
                              <br>
                                <option value="<?=$val['value']?>"><?= $val['label']?></option>
                            <?php
                        }
                       ?>
                    </select>
                </div>
            <?php } ?> 
        </div>
        <br>
        <?php
        }
    }
    function save_all_infomation(){

    }
    
}
$mycustom = new MB_Personalized;

$mycustom->load();