  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?
  if(empty($brukernavn)) { header("Location: index.php"); } else {
    botcheck_add_event($userinfo['brukerid'], $userinfo['brukernavn'], 'Brekk', 'brekk_funksjon3', time(), $db);

  // Beregn sansynlighet
  $PS = Bare_Siffer(BSjangs($Valgt));
  if($PS == '0') { $Avgjor = array("NEI","NEI"); }
  elseif($PS == '10') { $Avgjor = array("JA","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '30') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","NEI","NEI","NEI","NEI"); }
  elseif($PS == '50') { $Avgjor = array("JA","NEI","JA","NEI","JA","NEI","JA","NEI","JA","NEI"); }
  elseif($PS == '70') { $Avgjor = array("JA","JA","JA","NEI","JA","NEI","JA","NEI","JA","JA"); } else { $Avgjor = array("NEI","NEI"); }
  $SubAvgjor = array("Fengsel","Respekt","Ikkeno","Ikkeno","Ikkeno","Ikkeno","Respekt","Ikkeno","Ikkeno","Ikkeno","Fengsel");
  $Avgjor = $Avgjor[array_rand($Avgjor)];
  $SubAvgjor = $SubAvgjor[array_rand($SubAvgjor)];

  $NyVentetid = $Timestamp + '100';
  $BrekkTall = $brekk_gjort + '1';

  if($Avgjor == 'JA') { 
  $Tjen = rand(600, 1600); 
  $TjenFormat = VerdiSum($Tjen,'kroner');
  $Meld = array("Vellykket! taxisjåføren hadde pause så du gikk bare til bilen og stjal $TjenFormat.","Du kjørte hodet til taxisjåføren i dashbordet. Han ble bevistløs og du fikk med deg $TjenFormat.","Det gikk fint å stjele pengene fra taxisjåføren, du tjente $TjenFormat.","Du tok pengene til taxisjåføren og tjente $TjenFormat.","Du gikk inn i bilen og slo ned taxisjåføren og tjente $TjenFormat.","Alt gikk fort å raskt du tjente $TjenFormat.","Du stjal $TjenFormat.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRankpros = $rankpros + GainPros($rank_niva);
  $NyPengesum = floor($penger + $Tjen);  

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',penger='$NyPengesum',rankpros='$NyRankpros',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Fengsel') { 
  $Meld = array("Du ble busta.","Du ble tatt av en politimann.","Taxisjåføren var sivilsnut på arbeid, du ble tatt.","Purken slo deg ned og kastet deg i cella.","Du ble tatt av en purk.","Taxisjåføren slo deg i svime og kjørte deg til purken.","Taxisjåføren sa ifra til purken, du ble tatt.");
  $Meld = $Meld[array_rand($Meld)];
  $Straff = $Timestamp + '180';

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  mysql_query("INSERT INTO fengsel (brukernavn,tatt_for,straff_min,kjop_ut_sum,timestamp_over,timestampen,land) VALUES ('$brukernavn','Tyveri','3','3000000','$Straff','$Timestamp','$land')");
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Respekt') { 
  $skjoon_tekst = rand (1, 2); 
  if($skjoon_tekst == '1') { $tekst_navn = array("Henrik","Adrian","Sindre","Christian","Lars","Ragnar","Simen","Stig","Marius","Paul","Jørgen","Marcus","Anders","Stefan","Steffen"); $tekst_to_eid = 'mannen'; } else { $tekst_navn = array("Hanna","Tone","Ane","Caroline","Heidi","Ellen","Magnhild","Torild","Hilde","Emilie","Camilla","Monica","Oda sofie","Tina","Connie"); $tekst_to_eid = 'dama'; }
  $tekst_navn = $tekst_navn[array_rand($tekst_navn)];
  $Meld = array("Du fikk ingen spenn så du tok taxisjåføren og kastet han ned i asfalten, du sparket han i tryne. Du gikk opp i respekt.","Du fikk ingen spenn så du klikka mentalt på en random person ved navn $tekst_navn, du gikk opp i respekt.","Du fikk ingen penger av taxisjåføren $tekst_navn så du slo til $tekst_to_eid, du gikk opp i respekt.","Taxisjåføren nektet å gi deg pengene så du slo inn skallen hans og stakk, du gikk opp i respekt men fikk ingen penger med deg.","Taxisjåføren hadde ingen penger så du banket dritten ut av han, du gikk opp i respekt.");
  $Meld = $Meld[array_rand($Meld)];
  $NyRespekt = floor($respekt + '60');

  mysql_query("UPDATE brukere SET respekt='$NyRespekt',brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_1\">$Meld</span></td></tr>";
  }
  elseif($SubAvgjor == 'Ikkeno') { 
  if($land == 'Hamar') { $botan = array("Du møtte på selveste botan, han dreit på deg å gikk videre, du feilet.","Du var uheldig denne gangen, du møtte på taxisjåføren ved navn botan. Han dreit deg ut offentlig, du feilet.","Taxisjåføren botan lo av det tragiske forsøket ditt på å ta pengene hans."); } else { $botan = array("Du klarte det ikke.","Du datt foran taxibilen, du feilet"); }
  $botan = $botan[array_rand($botan)];
  $Meld = array("Du feilet.","$botan","Du klarte ikke å ta pengene til taxisjåføren.","Du klarte ikke å stjele fra taxisjåføren.","Du prøvde og ta pengene men klarte ikke.","Du prøvde og stjele pengene til taxisjåføren men du ble banket opp.");
  $Meld = $Meld[array_rand($Meld)];

  mysql_query("UPDATE brukere SET brekk_tid='$NyVentetid',brekk_gjort='$BrekkTall',aktiv_eller='$Aktiv' WHERE brukernavn='$brukernavn'"); 
  echo "<tr><td class=\"R_8\" style=\"height:25px;\"><span class=\"T_2\">$Meld</span></td></tr>";
  }}
  ?>