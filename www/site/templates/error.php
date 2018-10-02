<?php

  header::redirect($site->redirect404() . $_SERVER['REQUEST_URI'], 308);
