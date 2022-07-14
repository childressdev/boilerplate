<?php
  $link = get_field('button_link');

  if(!$link){
    $link['url'] = '#';
    $link['target'] = '_self';
    $link['title'] = 'Button';
  }

  $btn_class = 'btn-main';

  if(!empty($block['className'])){
    $btn_class .= ' ' . $block['className'];
  }

  $align = $block['align'];
  $block_open_class = '';

  $block_open = '';
  $block_close = '';
  switch($align){
    case 'left':
      $block_open = '<p class="text-start mb-0">';
      $block_close = '</p>';
    break;

    case 'right':
      $block_open = '<p class="text-end mb-0">';
      $block_close = '</p>';
    break;

    case 'center':
      $block_open = '<p class="text-center mb-0">';
      $block_close = '</p>';
    break;

    default:
  }

  if($link['target']){
    $target = $link['target'];
  }
  else{
    $target = '_self';
  }

  $onclick = '';
  if($is_preview){
    $onclick = ' onclick="return false;"';
  }

  echo $block_open;
    echo '<a href="' . esc_url($link['url']) . '"
              class="' . $btn_class . '"' . 
              $onclick . '
              target="' . $target . '">' . 
            esc_html($link['title']) . 
          '</a>';
  echo $block_close;