/* if(count($adsBanner) > 0){
                     $i=0;
                     foreach($adsBanner as $ads){
                         $adsL=Ad::select('ads.id',DB::raw('CONCAT("'.$this->imageBaseURL.'ads/",image) as image'))->where(['is_active'=>1])->where('start_date','<',now())->where('end_date','>',now());
                          if(isset($request->category_id) && !empty($request->category_id))
                            {

                                  $adsL=$adsL->where("category_id",$request->category_id);
                            }
                             if($ads->plan_id==1){
                                //  $adsList[$i]['type']='1_4_page';
                                 $adsList['1_4_page']=$adsL->where('plan_id',$ads->plan_id)->latest()->get() ?? [];
                                 $this->adViewCount($adsList['1_4_page'],$request->lat,$request->long);

                             }
                            if($ads->plan_id==2){
                                // $adsList[$i]['type']='1_2_page';
                                 $adsList['1_2_page']=$adsL->where('plan_id',$ads->plan_id)->latest()->get() ?? [];
                                $this->adViewCount($adsList['1_2_page'],$request->lat,$request->long);
                             }
                             if($ads->plan_id==3){
                                //   $adsList[$i]['type']='full_page';
                                 $adsList['full_page']=$adsL->where('plan_id',$ads->plan_id)->latest()->get() ?? [];
                                $this->adViewCount($adsList['full_page'],$request->lat,$request->long);
                             }
                             if($ads->plan_id==4){
                                //   $adsList[$i]['type']='banner_ad';
                                 $adsList['banner_ad']=$adsL->where('plan_id',$ads->plan_id)->latest()->get() ?? [];
                               $this->adViewCount($adsList['banner_ad'],$request->lat,$request->long);
                             }
                             $i++;

                    }
                 } */
