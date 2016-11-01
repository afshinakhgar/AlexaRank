<?php namespace AlexaRank;
class AlexaRank {
	public $fileCacheAddress = 'cache.txt';
	public function getRank($siteUrl){
		// load alexa api 
		$xml = simplexml_load_file("http://data.alexa.com/data?cli=10&url=".$siteUrl);
			if($xml){
				$alexaRank['reach'] = (int)$xml->SD->REACH->attributes()->RANK;
				// world rank of a site
				$alexaRank['w_rank'] = (int)$xml->SD->POPULARITY->attributes()->TEXT;
				// local country rank
				$alexaRank['local_rank'] = (int)$xml->SD->COUNTRY->attributes()->RANK;
				echo 'site Worl Rank : '.$alexaRank['w_rank']. ' Local Rank is ['.$alexaRank['local_rank'] .']  ==> '.$siteUrl;
				echo '<br>===========<br>';
			} else {
				echo 'Error : site : '.$alexaRank['w_rank']. ' is Not updated! ==> '.$siteUrl;
				echo '<br>===========<br>';
			}
			// add time for detecting update time
			$alexaRank['time'] =  date('Y-m-d',time());
		
		return $alexaRank;
	}


	public function getMultipleRanks($sites)
	{
		$cnt = 1;
		foreach($sites as $sitename => $site){
			$RankDataArr[$cnt][$site] = $this->getRank($site);
			$cnt++;
		}
		return $RankDataArr;
	}

	/*Cashe alexa rank Data In a file with json Format */
	public function cacheinfile($alexaRank)
	{
		if($alexaRank){
			file_put_contents($this->fileCacheAddress,json_encode($alexaRank));
		}
	}


	/* get Cashe alexa rank Data In a file with json Format */
	public function getRankFromCache()
	{
		$alexarankFileArr = file_get_contents($this->fileCacheAddress);
		$alexaRank = json_decode($alexarankFileArr,true);

		return $alexaRank;
	}
}