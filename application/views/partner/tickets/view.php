<?php
require_once(APPPATH.'views/header-partner.php');
require_once(APPPATH.'views/sidebar-partner.php');
?>

<div class="container">
    <h3 class=" text-center">Messaging</h3>
    <div class="messaging">
        <div class="inbox_msg">
            <div class="mesgs">
                  <div class="msg_history">
                      <?php

                        // $ticket_info = $this->globals->get_ticket($id);
                        $login = $this->session->get_userdata();
                        $customer_info = $this->globals->get_customer($login['customer_login_id']);
                        if(isset($all_ticket) && !empty($all_ticket)):
                          foreach($all_ticket as $key => $item):  
                              
                      ?>

                      <!-- nếu k tồn tại user -->

                      <?php if($item['user_id'] > 0): ?>

                      
                      <div class="incoming_msg">


                          <div class="incoming_msg_img">
                              <span>
                              <?php $curent_user_info = $this->globals->get_user($item['user_id']); echo $curent_user_info['fullname']; ?>

                              </span>
                          </div>


                          <div class="received_msg">
                              <div class="received_withd_msg">
                                  <p>

                                      <?php echo $item['content']; ?>
                                  </p>
                                  <span class="time_date">

                                      <?php echo $item['create_at']; ?>
                                  </span>
                              </div>
                          </div>
                      </div>

                      <?php else: ?>
                      <div class="outgoing_msg">
                          <div class="sent_msg">
                              <p><?php echo $item['content'] ?></p>
                              <span class="time_date">
                                  <b><?php $curent_user_info = $this->globals->get_user($item['user_id']); echo $curent_user_info['fullname']; ?>
                                  </b> | <?php echo $item['create_at']; ?>
                              </span>
                          </div>
                      </div>
                      <!--  -->
                      <?php endif; ?>
                      <?php endforeach; endif; ?>


                  </div>


                <div class="type_msg">
                    <form class="input_msg_write" method="post" action="">
                        <input type="text" class="write_msg" name="mess" placeholder="Nội dung trả lời" />
                        <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o"
                                aria-hidden="true"></i></button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>


<?php
require_once(APPPATH.'views/footer-partner.php');
?>