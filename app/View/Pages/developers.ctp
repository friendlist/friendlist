<?php $this->layout = "manager" ?>

<div class="well"> 

<h1>Developer documentation</h1>

<hr>
  
<h2>Creating the Hash</h2>
  
<p style="text-align: justify;">All URLs on gripr are based on the use of the hashed value of an email address. Data is accessed via the hash of an email, and it is considered the primary way of identifying an identity within the system. Url are created following this model:</p>
  
<pre class="prettyprint">
$hash = trim("MyEmailAddress@example.com"); // "MyEmailAddress@example.com"
$hash = strtolower($hash); // "myemailaddress@example.com"
echo md5($hash); // "0bc83cb571cd1c50ba6f3e8a78ef1346"
</pre>

<p>This can be combined in a single line :</p>

<pre class="prettyprint">
echo md5(strtolower(trim("MyEmailAddress@example.com")));
</pre>

<h2>Getting the url</h2>

<p style="text-align: justify;">All URLs on gripr are based on the use of the hashed value of an email address. Data is accessed via the hash of an email, and it is considered the primary way of identifying an identity within the system. Url are created following this model:</p>

<code>http://gripr.co/profile/HASH</code>

<p style="margin-top: 10px;">Using the above obtained hash, the url would look like :</p>

<code>http://gripr.co/profile/0bc83cb571cd1c50ba6f3e8a78ef1346</code>

<p style="margin-top: 10px;">This will link by default to a PHP version of the profile. You can get a JSON or XML version by adding <code>.json</code> or <code>.xml</code> to the end of the url:</p>

<code>http://gripr.co/profile/0bc83cb571cd1c50ba6f3e8a78ef1346.json</code>

<p style="margin-top: 10px;">or</p>

<code>http://gripr.co/profile/0bc83cb571cd1c50ba6f3e8a78ef1346.xml</code>

<h2 style="margin-top: 20px;">Extracting data from XML</h2>

<p>You can easily get any data from the XML url you just created. First, import our XML with one of the following methods:</p>
	
<pre class="prettyprint">
//get the XML profile with file_get_contents
$data = file_get_contents('http://gripr.co/profile/HASH.xml');
$response = SimpleXMLElement($data);
</pre>

<pre class="prettyprint">
//get the XML profile with simplexml_load_file
$response = simplexml_load_file('http://gripr.co/profile/HASH.xml');
</pre>

		<p>Importing our XML will produce an array like this:</p>
	
<pre class="prettyprint">
object(SimpleXMLElement) {
	user => object(SimpleXMLElement) {
		username => 'Jean Fau'
		about => 'Lorem ipsum tralala'
		location => 'Lyon, France'
		email => 'jeanfau@gmail.com'
	}
	licenses => object(SimpleXMLElement) {
		text => object(SimpleXMLElement) {
			abr => 'CC BY 3.0'
			full => 'Attribution 3.0 Unported'
			url => 'http://creativecommons.org/licenses/by/3.0/'
		}
		photo => object(SimpleXMLElement) {
			abr => 'CC BY-ND 3.0'
			full => 'Attribution-NoDerivs 3.0 Unported'
			url => 'http://creativecommons.org/licenses/by-nd/3.0/'
		}
		video => object(SimpleXMLElement) {
			abr => 'cc'
			full => 'cc'
			url => 'http://'
		}
		sound => object(SimpleXMLElement) {
			abr => 'cc'
			full => 'cc'
			url => 'http://'
		}
		code => object(SimpleXMLElement) {
			abr => 'cc'
			full => 'cc'
			url => 'http://'
		}
	}
}
</pre>

<p>Then select the info you want to diplay:</p>
	
<pre class="prettyprint">
//user info
echo $response->user->username; //user name
echo $response->user->about; //about user
echo $response->user->location; //user location
echo $response->user->email; //user email
//user licenses
echo $response->licenses->text->value; //text license value
echo $response->licenses->text->url; //text licence url
</pre>

<h2 style="margin-top: 20px;">Extracting data from JSON</h2>
	
<pre class="prettyprint">
//get the JSON profile with file_get_contents
$json = file_get_contents('http://gripr.co/profile/HASH.json');
$response = json_decode($json); 
</pre>

<p>Importing our JSON will produce an array like this:</p>
		
<pre class="prettyprint">
object(stdClass) {
	response => object(stdClass) {
		user => object(stdClass) {
			username => 'jeanfau'
			pseudo => null
			about => null
			location => null
			email => 'jeanfau@gmail.com'
		}
		licenses => object(stdClass) {
			text => object(stdClass) {
				abr => 'CC BY 3.0'
				full => 'Attribution 3.0 Unported'
				url => 'http://creativecommons.org/licenses/by/3.0/'
			}
			picture => object(stdClass) {
				abr => 'CC BY-ND 3.0'
				full => 'Attribution-NoDerivs 3.0 Unported'
				url => 'http://creativecommons.org/licenses/by-nd/3.0/'
			}
			video => object(stdClass) {
				abr => 'cc'
				full => 'cc'
				url => 'http://creativecommons.org/licenses/by-nd/3.0/'
			}
			sound => object(stdClass) {
				abr => 'cc'
				full => 'cc'
				url => 'cc'
			}
			code => object(stdClass) {
				abr => 'MIT'
				full => 'MIT License'
				url => 'cc'
			}
		}
	}
}
</pre>

<p>Then select the info you want to diplay:</p>
		
<pre class="prettyprint">
//user info
echo $response->user->username; //user name
echo $response->user->about; //about user
echo $response->user->location; //user location
echo $response->user->email; //user email
//user licenses
echo $response->licenses->text->value; //text license value
echo $response->licenses->text->url; //text licence url
</pre>

</div> 

<?php echo $this->element('footer'); ?>