<?php
	class Imagem{
		private $img;
		public $width;
		public $height;
		public $vetor;
		
		function __construct($img_src = 'img/img_pb.jpg'){
			$this->img = imagecreatefromjpeg($img_src);
			$this->width = imagesx($this->img);
			$this->height = imagesy($this->img);
			
			$cor = array();
			$keys = array();
			for($i = 0; $i < $this->width; $i++){
				for($j = 0; $j < $this->height; $j++){
					$color_index = imagecolorat($this->img, $i, $j);
					$arr = imagecolorsforindex($this->img, $color_index);
					$color_index = $arr['red']*0.299 + $arr['green']*0.587 + $arr['blue']*0.114;
					$cor[$color_index]++;
				}
			}
			ksort($cor);
			$this->vetor = $cor;
		}
		
		public function escreve(){
			echo '<pre>';
			print_r($this->vetor);
			echo '</pre>';
		}
		
		public function esqualizar(){
			$vet = array();
			$gk = 0;
			$niveis_de_cinza = 255;
			
			$size = $this->width * $this->height;
			foreach($this->vetor as $i => $num){
				$gk += $num / $size;
				$vet[$i] = round($gk * $niveis_de_cinza);
			}
			
			$img_new = imagecreatetruecolor($this->width, $this->height);
			for($i = 0; $i < $this->width; $i++){
				for($j = 0; $j < $this->height; $j++){
					$color_index = imagecolorat($this->img, $i, $j);
					$arr = imagecolorsforindex($this->img, $color_index);
					$color_index = $arr['red']*0.299 + $arr['green']*0.587 + $arr['blue']*0.114;
					
					$to = $vet[$color_index];
					//imagecolorset($img_new, imagecolorat($img_new, $i, $j), $arr['red'], $arr['green'], $arr['blue']);
					imagesetpixel($img_new, $i, $j, imagecolorallocate($img_new, $to, $to, $to)); 
				}
			}
			header("Content-type: image/jpeg");
			imagejpeg($img_new);
			
			/*echo '<pre>';
			print_r($vet);
			echo '</pre>';*/
		}
	}
?>