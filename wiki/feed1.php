<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en-gb">
<link rel="self" type="application/atom+xml" href="https://love2d.org/forums/feed.php" />

<title>LÖVE</title>
<link href="https://love2d.org/forums/index.php" />
<updated>2016-04-02T21:50:53</updated>

<author><name><![CDATA[LÖVE]]></name></author>
<id>https://love2d.org/forums/feed.php</id>
<entry>
<author><name><![CDATA[ZBoyer1000]]></name></author>
<updated>2016-04-02T21:50:53</updated>
<published>2016-04-02T21:50:53</published>
<id>https://love2d.org/forums/viewtopic.php?t=82046&amp;p=197112#p197112</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82046&amp;p=197112#p197112"/>
<title type="html"><![CDATA[General • Mini Functions Repository]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82046&amp;p=197112#p197112"><![CDATA[
I thought it would be neat to create a place where people could post small functions that can do useful things and possibly help other people's projects.  <img class="smilies" src="https://love2d.org/forums/images/smilies/ms-glad.png" alt=":D" title="Very Happy" /> <br /> <br />Here is a function I created that could help create game clocks:<br /><blockquote class="uncited"><div><br />gameClocks = {}<br />function clock(name, time)<br />index = 0<br /> for i = 1,#gameClocks do<br />   if gameClocks[i][1] == tostring(name) then<br /> index = i<br />   end<br /> end<br /> if index == 0 then<br />   local clock = {tostring(name), num = 0}<br />   table.insert(gameClocks, clock)<br /> elseif index ~= 0 then<br />   gameClocks[index].num = gameClocks[index].num + 1<br />   if gameClocks[index].num &gt;= time then gameClocks[index].num = 0 return true end<br /> end<br />end<br /></div></blockquote><br />Here is an example for it:  <img class="smilies" src="https://love2d.org/forums/images/smilies/ms-surprised2.png" alt=":o:" title="Oh" /> <br />l = 0<br />z = 0<br />function love.update(dt)<br /> if clock(&quot;LClock&quot;, 20) == true then  <br /> l = l + 1 <br /> end<br /> if clock(&quot;ZClock&quot;, 1) == true then  <br /> z = z + 1 <br /> end<br /> love.graphics.print(tostring(z) .. &quot; : &quot; .. tostring(l))<br />end<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=137266">ZBoyer1000</a> — Sat Apr 02, 2016 9:50 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[pgimeno]]></name></author>
<updated>2016-04-02T21:19:27</updated>
<published>2016-04-02T21:19:27</published>
<id>https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197111#p197111</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197111#p197111"/>
<title type="html"><![CDATA[Support and Development • Re: How to serialize/deserialize a SoundData object?]]></title>

<category term="Support and Development" scheme="https://love2d.org/forums/viewforum.php?f=4" label="Support and Development"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197111#p197111"><![CDATA[
It might, but my experience with jackd has been pretty unsatisfactory in general (re setup time and getting everything back into a working state again after using it) and I'm not very motivated to test for now. I'll probably just adjust the buffer for the game and move on. Being in the low end helps anticipating what problems other users may find.<br /><br />Anyway, back to the topic, serialization/deserialization can be done with FFI like in my example, creating a pointer and accessing the data that way.<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=137168">pgimeno</a> — Sat Apr 02, 2016 9:19 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[mr_happy]]></name></author>
<updated>2016-04-02T21:13:45</updated>
<published>2016-04-02T21:13:45</published>
<id>https://love2d.org/forums/viewtopic.php?t=82041&amp;p=197110#p197110</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82041&amp;p=197110#p197110"/>
<title type="html"><![CDATA[Projects and Demos • Re: Lovely Tetromino]]></title>

<category term="Projects and Demos" scheme="https://love2d.org/forums/viewforum.php?f=5" label="Projects and Demos"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82041&amp;p=197110#p197110"><![CDATA[
Good stuff and it plays ok but I noticed these things:<br /><br /><ul><li>I think you need to flush the input after using 'down' (fast fall or whatever you might call it - as a former Tetris monster I used that key habitually until the score got up into the tens of thousands!) as it continues to affect the next piece which I'm pretty sure didn't happen in the original.<br /></li><li>The music made me laugh, started like a church service then went off into the cheeeeeeziest chord progression. I had to turn it off quickly <img class="smilies" src="https://love2d.org/forums/images/smilies/ms-glad.png" alt=":D" title="Very Happy" /><br /></li><li>One cell in each piece is brighter than the rest (eg the centre in the T-shaped piece) - not sure if that is intentional but couldn't think of a reason for it (or maybe it's not brighter, it's just my old eyes?!)<br /></li><li>There's a bit of shearing when drawing/moving the pieces; I had a <em>very</em> quick look at the code and spotted some things you could optimise although <strong>I'm not sure how much difference they would make</strong> - eg removing the function call for GameGrid.RenderTile that gets called about 200 times every frame and placing it in-line, removing the algebraic operations from that function etc. I know little about Love/Lua atm but I suspect that creating/blitting an image for the grid squares would be quicker than using primitives to draw them.</li></ul><br />Nice clean code though, even for a Love novice like me to follow!<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=137691">mr_happy</a> — Sat Apr 02, 2016 9:13 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[airstruck]]></name></author>
<updated>2016-04-02T21:12:24</updated>
<published>2016-04-02T21:12:24</published>
<id>https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197109#p197109</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197109#p197109"/>
<title type="html"><![CDATA[Support and Development • Re: How to serialize/deserialize a SoundData object?]]></title>

<category term="Support and Development" scheme="https://love2d.org/forums/viewforum.php?f=4" label="Support and Development"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197109#p197109"><![CDATA[
<blockquote><div><cite>pgimeno wrote:</cite><br />it may have to do with PulseAudio; I've heard it has latency issues<br /></div></blockquote><br /><br />Have you tried using jackd instead of PA? I wonder if you could get lower latency that way. Either way, might help determine where the latency issue is coming from.<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=136704">airstruck</a> — Sat Apr 02, 2016 9:12 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[Mateus]]></name></author>
<updated>2016-04-02T20:48:08</updated>
<published>2016-04-02T20:48:08</published>
<id>https://love2d.org/forums/viewtopic.php?t=82045&amp;p=197108#p197108</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82045&amp;p=197108#p197108"/>
<title type="html"><![CDATA[General • Please answer a quick form.]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82045&amp;p=197108#p197108"><![CDATA[
Hello, I hope I don't break any rules. I had lot of troubles figuring out how to build easily for android API 10 or lower/higher.<br /><br />Just to be sure I made a quick form and I would really apreciate if you could answer. THANKS A LOT!<br /><br /><a href="http://goo.gl/forms/bXGN51QEGA" class="postlink">http://goo.gl/forms/bXGN51QEGA</a><p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=136502">Mateus</a> — Sat Apr 02, 2016 8:48 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[airstruck]]></name></author>
<updated>2016-04-02T19:58:10</updated>
<published>2016-04-02T19:58:10</published>
<id>https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197106#p197106</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197106#p197106"/>
<title type="html"><![CDATA[General • Re: How to document an &quot;unusual&quot; API?]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197106#p197106"><![CDATA[
<blockquote><div><cite>Kingdaro wrote:</cite><br />It seems like the best thing you can do is just give an example of how its used. I think the examples in the docs are good enough to give a good picture.<br /></div></blockquote><br /><br />Examples are pretty important for something like this, I agree. I want anyone looking at it to be able to immediately figure out what it's for. It might be alright with a few more examples.<br /><br /><blockquote><div><cite>ivan wrote:</cite><br />I strongly believe that having trouble naming functions or documenting them, is a sign that something is wrong with the code.<br /></div></blockquote><br /><br />The two internal functions only have names because they refer to themselves and each other. The names aren't part of the API; the user doesn't have to deal with remembering any names, only function signatures.<br /><br />The first internal function is never exposed, so there's no reason to have user-facing documentation for it. The second is returned by the &quot;chain factory&quot; and by &quot;chain instances.&quot; It represents a &quot;chain instance&quot; itself, and it's named &quot;chain&quot; internally. I'm open to suggestions for better names for things, but this really doesn't seem that bad to me.<br /><br /><blockquote><div><cite>ivan wrote:</cite><br />Also, please note that you have to be careful when using &quot;local function&quot; and &quot;return function&quot; because these have their own scope which is a strain on the GC [...] For example, &quot;local links = nil&quot; could be the first line, since &quot;links&quot; is used in all of your functions.<br /></div></blockquote><br /><br />The closure is there for a reason. The internal functions operate on the &quot;links&quot; table defined by the &quot;chain factory&quot; function exposed by the module. If &quot;links&quot; were moved out of the closure, you'd have all chains sharing one set of links, instead of each chain having its own links. This wouldn't give the desired behavior.<br /><br />The functions could be moved out of the closure and could accept &quot;links&quot; as a parameter instead (procedural approach), except that the user never has access to &quot;links&quot; and wouldn't be able to pass them in when executing the chain. Even if they could, I don't think this API would be very pleasant.<br /><br />The other option would be an OO approach, essentially attaching the user-facing function to the table and returning that table instead of just returning a function in a closure (as Kingdaro hinted at). The API could actually stay the same with __call, but the &quot;links&quot; table is exposed which I don't really want. It's supposed to be immutable except through that user-facing function, which is why it's created from varargs in the first place instead of letting the user pass in a table that they'd have a handle to and could mess with later.<br /><br />In any case, I'm not convinced that the OO approach really has any benefit over closures in this case. I'd be interested in seeing a performance test, though.  <br /><br /><blockquote><div><cite>substitute541 wrote:</cite><br />Here's an inline documentation example<br /></div></blockquote><br /><br />Thanks, I'll run that through Ldoc later and see what happens. In the past I've had trouble getting Ldoc to do anything useful with annotations on internal stuff. Just looking at it, I'm wondering if the only thing that will show up is the very first annotation for &quot;chain factory&quot;.<br /><br /><blockquote><div><cite>substitute541 wrote:</cite><br />I also suggest refactoring the code and/or finding a different way to do this thing. It's incredibly confusing.<br /></div></blockquote><br /><br />I'm open to concrete, viable suggestions on refactoring it. The way it's done now is the simplest way I can think of to do it. If you can think of a simpler or clearer way, I'd be happy to use that instead.<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=136704">airstruck</a> — Sat Apr 02, 2016 7:58 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[pgimeno]]></name></author>
<updated>2016-04-02T19:46:22</updated>
<published>2016-04-02T19:46:22</published>
<id>https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197105#p197105</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197105#p197105"/>
<title type="html"><![CDATA[Support and Development • Re: How to serialize/deserialize a SoundData object?]]></title>

<category term="Support and Development" scheme="https://love2d.org/forums/viewforum.php?f=4" label="Support and Development"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197105#p197105"><![CDATA[
I will also need a continuous generated sound for Thrust II Reloaded, so I have made a proof of concept of using QueueableSource and FFI to generate sound in real(ish) time. For some reason, any buffer under 0.05 seconds clicks, even if vsync is disabled (it may have to do with PulseAudio; I've heard it has latency issues) so that's the minimum latency in my case.<br /><br /><div class="codebox"><p>Code: </p><code>local ffi = require('ffi')<br />local QueueableSource = require('love-microphone.QueueableSource')<br /><br />local soundData<br />local sampleptr<br />local qs = QueueableSource:new(2)<br /><br />-- These parameters are for any application<br />local bufsize = 0.05 -- buffer size in seconds<br />local chans = 1<br />local rate = 48000<br />local nsamples = math.floor(bufsize * rate + 0.5)<br /><br />-- Our example consists of generating a continuous tone.<br />-- These parameters govern the tone's generation.<br /><br />local freq = 440<br />local invrate = 2*math.pi/rate<br />local vol = 1 -- Range 0 to 1. Unfortunately, QueueableSource lacks setVolume().<br /><br />local t, t_mod<br />local nsamp_chans = nsamples * chans<br /><br />local function fill_buf()<br />  -- We have to be extra-careful, as we're accessing raw memory and we can<br />  -- potentially cause a bad crash if we go out of bounds.<br /><br />  -- Note the FFI array uses 0 as first index, not 1.<br /><br />  t_mod = 0<br />  while t_mod &lt; nsamp_chans do<br />    local v = math.floor(math.sin(t*freq*invrate) * 32767 * vol + 0.5)<br />    for i = 1, chans do<br />      sampleptr&#91;t_mod&#93; = v<br />      t = t + 1<br />      t_mod = t_mod + 1<br />    end<br />  end<br />end<br /><br />function love.load(args)<br />  -- Test vsync on/off by commenting out or enabling this line<br />--  love.window.setMode(800, 600, {vsync=false})<br /><br />  -- Prepare our SoundData object<br />  soundData = love.sound.newSoundData(nsamples, rate, 16, chans)<br /><br />  -- Initialize FFI pointer<br />  sampleptr = ffi.new(&quot;int16_t *&quot;, soundData:getPointer())<br /><br />  -- Fill first round<br />  t = 0<br />  fill_buf()<br /><br />  qs:queue(soundData)<br />  qs:play()<br />end<br /><br />local DT, DTmin, DTmax<br />local framesToStabilize = 3 -- this is related to FPS, not to audio<br /><br />function love.update(dt)<br />  if framesToStabilize == 0 then<br />    if not DTmin then DTmin, DTmax = dt, dt end<br />    DT = dt<br />  end<br /><br />  qs:step()<br />  if qs:getFreeBufferCount() ~= 0 then<br />    fill_buf()<br />    qs:queue(soundData)<br />    qs:play()<br />  end<br />end<br /><br />function love.draw()<br />  if framesToStabilize == 0 then<br />    DTmin = math.min(DT, DTmin)<br />    DTmax = math.max(DT, DTmax)<br />    love.graphics.print(&quot;FPS: min &quot; .. 1/DTmax .. &quot; max &quot; .. 1/DTmin .. &quot; current &quot; .. 1/DT)<br />  else<br />    framesToStabilize = framesToStabilize - 1<br />  end<br />end<br /><br />function love.keypressed(k)<br />  if k == &quot;escape&quot; then love.event.quit() end<br />end<br /></code></div><p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=137168">pgimeno</a> — Sat Apr 02, 2016 7:46 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[Kingdaro]]></name></author>
<updated>2016-04-02T18:48:55</updated>
<published>2016-04-02T18:48:55</published>
<id>https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197104#p197104</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197104#p197104"/>
<title type="html"><![CDATA[General • Re: How to document an &quot;unusual&quot; API?]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197104#p197104"><![CDATA[
<blockquote><div><cite>ivan wrote:</cite><br />I strongly believe that having trouble naming functions or documenting them, is a sign that something is wrong with the code.<br /></div></blockquote><br />A super good point, something a lot of people tend to miss, including myself! Though I can't really think of any better way for the library to work, other than the common &quot;instance = module.new()&quot; and &quot;instance:stuff()&quot; methods, which would probably just make it look a little bloated in use.<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=1297">Kingdaro</a> — Sat Apr 02, 2016 6:48 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[DavidOliveiraSilva]]></name></author>
<updated>2016-04-02T17:23:59</updated>
<published>2016-04-02T17:23:59</published>
<id>https://love2d.org/forums/viewtopic.php?t=80826&amp;p=197102#p197102</id>
<link href="https://love2d.org/forums/viewtopic.php?t=80826&amp;p=197102#p197102"/>
<title type="html"><![CDATA[Projects and Demos • Re: Loophole - 2D Puzzle Platformer]]></title>

<category term="Projects and Demos" scheme="https://love2d.org/forums/viewforum.php?f=5" label="Projects and Demos"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=80826&amp;p=197102#p197102"><![CDATA[
Amazing!<br />Very beautiful game. A bgm would be nice<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=136687">DavidOliveiraSilva</a> — Sat Apr 02, 2016 5:23 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[Tricky]]></name></author>
<updated>2016-04-02T15:23:51</updated>
<published>2016-04-02T15:23:51</published>
<id>https://love2d.org/forums/viewtopic.php?t=81969&amp;p=197101#p197101</id>
<link href="https://love2d.org/forums/viewtopic.php?t=81969&amp;p=197101#p197101"/>
<title type="html"><![CDATA[General • Re: Where and how did you start?]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=81969&amp;p=197101#p197101"><![CDATA[
I learned about Lua as a World of Warcraft player, since all its addons are merely Lua scripts.<br />The language I used (BlitzMax) had a Lua module and I started to study it. I came up with <a href="http://gamejolt.com/games/war-in-space-all-around-the-moon/19201" class="postlink">War in Space - All Around The Moon</a> in order to study the possibilities of Lua a bit more. It was never a serious project, but an experiment, but hey, maybe you like the game anyway, as I didn't really throw it, you know <img class="smilies" src="https://love2d.org/forums/images/smilies/ms-wink.png" alt=";)" title="Wink" /><br /><br />A really serious project with Lua came when I created <a href="http://gamejolt.com/games/the-secrets-of-dyrt/20688" class="postlink">The Secrets of Dyrt</a>. I just wanted to make an RPG again, and up until now I only had to reply on my own (crappy) scripting languages I didn't even care to give a name. <br /><br />During my time at GameJolt I heard somebody complain about Love2D being too &quot;low level&quot;, but that was actually something I liked. The two games above I mentioned are not exactly lightwight, and getting them to work on Linux, well they should both work with wine, but a true Linux version was just major hell. I was looking to a good Lua based engine for my smaller projects, and that complaint was just telling me Love2D could be what I was looking for. <br /><br />I'm now working to create a puzzle game, which is actually a remake of an older concept of mine, but perfect to get into the deep of Love2D. And I guess this will also be the first game of mine with an actual &quot;Linux version&quot;. The only thing I miss in Love is the support for the &quot;archiving&quot; system I used (and I can't expect it to, as I set up that system myself), as it grants me a lot of possibilities zip doesn't offer. Well, we can't have EVERYTHING, I guess.<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=136060">Tricky</a> — Sat Apr 02, 2016 3:23 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[Mateus]]></name></author>
<updated>2016-04-02T15:10:59</updated>
<published>2016-04-02T15:10:59</published>
<id>https://love2d.org/forums/viewtopic.php?t=82043&amp;p=197100#p197100</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82043&amp;p=197100#p197100"/>
<title type="html"><![CDATA[Support and Development • Love2d android for API 10]]></title>

<category term="Support and Development" scheme="https://love2d.org/forums/viewforum.php?f=4" label="Support and Development"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82043&amp;p=197100#p197100"><![CDATA[
Hey, is it possible to build LOVE apk for android 2.3.3 (API 10) ?<br /><br />Thanks!<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=136502">Mateus</a> — Sat Apr 02, 2016 3:10 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[fixylol]]></name></author>
<updated>2016-04-02T14:58:58</updated>
<published>2016-04-02T14:58:58</published>
<id>https://love2d.org/forums/viewtopic.php?t=81969&amp;p=197099#p197099</id>
<link href="https://love2d.org/forums/viewtopic.php?t=81969&amp;p=197099#p197099"/>
<title type="html"><![CDATA[General • Re: Where and how did you start?]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=81969&amp;p=197099#p197099"><![CDATA[
my first experience with lua was on a game engine(ish) called &quot;ROBLOX&quot;. however, their engine was very restricted (audio can only be 2 minutes long and you have to pay to upload it, images need to be approved, etc) and pretty laggy, so i decided to look for other engines that use lua. i then stumbled upon love2d. i'm currently working on my first project, a recreation of a game made in stagecast creator called awedd.sim (<a href="https://www.youtube.com/watch?v=crWQ42PePHE" class="postlink">https://www.youtube.com/watch?v=crWQ42PePHE</a>).<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=137590">fixylol</a> — Sat Apr 02, 2016 2:58 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[fixylol]]></name></author>
<updated>2016-04-02T14:46:59</updated>
<published>2016-04-02T14:46:59</published>
<id>https://love2d.org/forums/viewtopic.php?t=82042&amp;p=197098#p197098</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82042&amp;p=197098#p197098"/>
<title type="html"><![CDATA[General • love is planning world domination]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82042&amp;p=197098#p197098"><![CDATA[
just think about it:<br />if you mouse over love.exe or love.dll, it says the company is &quot;LOVE World Domination Inc.&quot;<br />almost every built-in function/callback/table in love is under the table &quot;love&quot;<br />one of the admins encouraged putting &quot;obey&quot; in the user avatars<br /><br />it is only a matter of time before love takes over the entire world with its cute art and easy to learn scripting...<br /><br />not enough? take a look at this:<br /><br />love is a 2d engine.<br /><br />love uses lua.<br /><br />lua has 3 letters.<br /><br />a triangle in 2d has 3 sides...<br /><br />oh my god...<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=137590">fixylol</a> — Sat Apr 02, 2016 2:46 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[mr_happy]]></name></author>
<updated>2016-04-02T14:36:25</updated>
<published>2016-04-02T14:36:25</published>
<id>https://love2d.org/forums/viewtopic.php?t=8633&amp;p=197097#p197097</id>
<link href="https://love2d.org/forums/viewtopic.php?t=8633&amp;p=197097#p197097"/>
<title type="html"><![CDATA[General • Re: Text adventures &amp; state machines (a newb approaches!)]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=8633&amp;p=197097#p197097"><![CDATA[
<blockquote><div><cite>Rucikir wrote:</cite><br />There's a good read imo <a href="http://gameprogrammingpatterns.com/" class="postlink">Game Programming Patterns</a>. It has a chapter on <a href="http://gameprogrammingpatterns.com/state.html" class="postlink">State Machines</a> with drawings, explanations on where and why use them, and code examples.<br /></div></blockquote><br /><br />That's a handy link - thanks! <img class="smilies" src="https://love2d.org/forums/images/smilies/ms-glad.png" alt=":D" title="Very Happy" /><p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=137691">mr_happy</a> — Sat Apr 02, 2016 2:36 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[kikito]]></name></author>
<updated>2016-04-02T14:27:15</updated>
<published>2016-04-02T14:27:15</published>
<id>https://love2d.org/forums/viewtopic.php?t=12033&amp;p=197096#p197096</id>
<link href="https://love2d.org/forums/viewtopic.php?t=12033&amp;p=197096#p197096"/>
<title type="html"><![CDATA[Projects and Demos • Re: [library] gamera - A camera system for LÖVE - v1.0.1 is out]]></title>

<category term="Projects and Demos" scheme="https://love2d.org/forums/viewforum.php?f=5" label="Projects and Demos"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=12033&amp;p=197096#p197096"><![CDATA[
@endlesstravel: There are several things wrong with your code. Let me explain:<br /><br /><ul><li>You are &quot;reusing&quot; the same camera (the variable called <strong>cam</strong>) to display two viewports. That is not a good idea. Instead, use two cameras, one called <strong>cam1</strong> and another called <strong>cam2</strong> (or <strong>camLeft</strong> and <strong>camRight</strong>). One will be used for the left &quot;window&quot; and the other for the right &quot;window&quot; (these are called &quot;viewports&quot; in gamera).</li><li>It seems you don't understand what the &quot;world&quot; is in gamera: The world is your &quot;how many pixels does your whole level have&quot; (with a 1:1 scale). I think in your case it is (0, 0, 1800, 800). And it should be that for both cameras, since they are on the same world. You don't need to &quot;set it up&quot; on every frame, just use that instead of (0,0,800,600) when creating the cameras.</li><li>Since your game world does not change in size while you play with it, you don't need to &quot;reset&quot; the world on every frame - you can leave it &quot;fixed&quot; when you create both cameras. </li><li>The same happens with the viewport and the scale. Since they don't change, you can set them once right after create the cameras. There is no need to do it on every frame. </li></ul><br /><br />@meowman9000:<br /><br />Your life would be much easier if your tiles were organized in a two-dimensional table, instead of using a monodimensional one. I have an article which explains both of them here: <!-- m --><a class="postlink" href="https://github.com/kikito/love-tile-tutorial/wiki/0b-tables">https://github.com/kikito/love-tile-tut ... /0b-tables</a><!-- m --><br /><br />There are several things on this line:<br /><div class="codebox"><p>Code: </p><code>love.graphics.draw(tileset, Quads&#91;mymap.layers&#91;1&#93;.data&#91;wholeMap&#91;visibleItems&#91;i&#93;&#93;&#91;1&#93;&#93;&#93;,wholeMap&#91;visibleItems&#91;i&#93;&#93;&#91;2&#93;,wholeMap&#91;visibleItems&#91;i&#93;&#93;&#91;3&#93;)</code></div><br /><br /><ul><li>First, you could make it easier to read (and also faster) if you used local variables for the repeated parts. <strong>wholeMap[visibleItems[i]</strong>, is a good candidate.</li><li>Second, your drawing function is called <strong> levelUpdate</strong>. Yet it doesn't update anything. That's quite misleading. It also has a comment right before it which says &quot;draw map&quot;. I strongly suggest you rename it to <strong>drawMap</strong> and remove that comment.</li><li>Third, the name bumpworldRef is very inconsistent. The uppercase/lowercase rule is broken (it should be <strong>bumpWorldRef</strong>, not <strong>bumpworldRef</strong>), and also you don't use &quot;Ref&quot; for other tables in your code, so you might as well remove that part, and leave it in <strong>bumpWorld</strong>.</li><li>Last, using &quot;magical numbers&quot; like [1], [2] and [3] makes the code less clear. If you can, organize your tables so that you use names instead - like &quot;quadName&quot;, &quot;x&quot; and &quot;y&quot;. The drawing code would look like this:</li></ul><br /><div class="codebox"><p>Code: </p><code>function drawLevel(bumpWorld)<br />   local visibleItems, len = bumpWorld:queryRect(0,0,800,600)<br />   for i=1, len do<br />     local tile = wholeMap&#91;visibleItems&#91;i&#93;&#93;<br />     local quad = Quads&#91;mymap.layers&#91;1&#93;.data&#91;tile.quadName&#93;&#93;<br />     love.graphics.draw(tileset, quad, tile.x, tile.y)<br />   end<br /> end<br /></code></div><p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=710">kikito</a> — Sat Apr 02, 2016 2:27 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[whitebear]]></name></author>
<updated>2016-04-02T13:02:48</updated>
<published>2016-04-02T13:02:48</published>
<id>https://love2d.org/forums/viewtopic.php?t=82041&amp;p=197095#p197095</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82041&amp;p=197095#p197095"/>
<title type="html"><![CDATA[Projects and Demos • Re: Lovely Tetromino]]></title>

<category term="Projects and Demos" scheme="https://love2d.org/forums/viewforum.php?f=5" label="Projects and Demos"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82041&amp;p=197095#p197095"><![CDATA[
<blockquote><div><cite>anastasiaorosegirl wrote:</cite><br />Thanks! are the controls listed somewhere?<br /></div></blockquote><br /><a href="https://drteaspoon.itch.io/lovelytet" class="postlink">https://drteaspoon.itch.io/lovelytet</a><p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=472">whitebear</a> — Sat Apr 02, 2016 1:02 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[zorg]]></name></author>
<updated>2016-04-02T12:53:57</updated>
<published>2016-04-02T12:53:57</published>
<id>https://love2d.org/forums/viewtopic.php?t=82021&amp;p=197094#p197094</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82021&amp;p=197094#p197094"/>
<title type="html"><![CDATA[Projects and Demos • Re: [WIP]BeatFever Mania ~ osu! Engine reimplementation]]></title>

<category term="Projects and Demos" scheme="https://love2d.org/forums/viewforum.php?f=5" label="Projects and Demos"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82021&amp;p=197094#p197094"><![CDATA[
C&amp;D?<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=80325">zorg</a> — Sat Apr 02, 2016 12:53 pm</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[MachineCode]]></name></author>
<updated>2016-04-02T11:55:06</updated>
<published>2016-04-02T11:55:06</published>
<id>https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197093#p197093</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197093#p197093"/>
<title type="html"><![CDATA[Support and Development • Re: How to serialize/deserialize a SoundData object?]]></title>

<category term="Support and Development" scheme="https://love2d.org/forums/viewforum.php?f=4" label="Support and Development"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197093#p197093"><![CDATA[
<blockquote class="uncited"><div><br />Also, when you say log compression on string encoding, do you mean compressing 16bit samplepoints into 8 bits? how would you get back the original 16bit fidelity though? I don't think it can be anything but lossless. Telephony log-compression like mu and a-law, like i wrote before, sacrifice enough to be (not even) decent for speech, but not music which has a greater range.<br /></div></blockquote><br /><br />Yes - you lose compared to 16 bit, but it's a bit better than storing 8 bit linear.  Assuming you don't clip, then most of the audio data will be at lower levels, so the log compression pushes more steps down there  at the expense of less resolution for the peaks.  I am mostly interested in noise and background loops - like a radio channel, so a bit of grainy sound is good.  Background music needs to be good quality, but some other sound effects can be grungy. I have a hunch that with some preprocessing, 8 bit u-law at 8KSa can be OK for some sound effects and voice channels.<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=135253">MachineCode</a> — Sat Apr 02, 2016 11:55 am</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[adekto]]></name></author>
<updated>2016-04-02T09:59:53</updated>
<published>2016-04-02T09:59:53</published>
<id>https://love2d.org/forums/viewtopic.php?t=82034&amp;p=197092#p197092</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82034&amp;p=197092#p197092"/>
<title type="html"><![CDATA[Projects and Demos • Re: [lib] maid64 - square low resolution system]]></title>

<category term="Projects and Demos" scheme="https://love2d.org/forums/viewforum.php?f=5" label="Projects and Demos"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82034&amp;p=197092#p197092"><![CDATA[
not sure if i should add a shader selection to maid64, any ideas or sugestions?<br /><br />made a cga mode and some others just to try it out, never done anything like this<br /><div class="codebox"><p>Code: </p><code>mode  = {<br />    &#91;&#91;  // mode 1 - CGA mode<br />        vec4 effect( vec4 color, Image texture, vec2 texture_coords, vec2 screen_coords )<br />        {<br />            vec4 texcolor = Texel(texture, texture_coords);<br />            vec4 col = step(0.5,texcolor);<br />            if(col == vec4(1.,1.,1.,1.)) return col * color;<br />            if(col == vec4(0.,0.,0.,1.)) return col * color;<br />            if(col.r == 1.0) col = vec4(1.,0.,1.,col.a);<br />            if(col.r == 0.) col = vec4(0.,1.,1.,col.a);<br />            return col * color;<br />        }<br />    &#93;&#93;<br />    ,<br />    &#91;&#91; // mode 2 - prime color mode<br />        vec4 effect( vec4 color, Image texture, vec2 texture_coords, vec2 screen_coords )<br />        {<br />            vec4 texcolor = Texel(texture, texture_coords);<br />            return step(0.5,texcolor) * color;<br />        }<br />    &#93;&#93;<br />    ,<br />    &#91;&#91; // mode 3 - 8bit color mode?<br />        vec4 effect( vec4 color, Image texture, vec2 texture_coords, vec2 screen_coords )<br />        {<br />            vec4 texcolor = Texel(texture, texture_coords);<br />            return  ((step(0.25,texcolor)+step(0.75,texcolor))/2)* color;<br />        }<br />    &#93;&#93;<br />    }<br /><br />    shader = love.graphics.newShader(mode&#91;1&#93;)<br />    love.graphics.setShader(shader)<br />    </code></div><p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=79341">adekto</a> — Sat Apr 02, 2016 9:59 am</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[Davidobot]]></name></author>
<updated>2016-04-02T09:00:39</updated>
<published>2016-04-02T09:00:39</published>
<id>https://love2d.org/forums/viewtopic.php?t=82021&amp;p=197091#p197091</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82021&amp;p=197091#p197091"/>
<title type="html"><![CDATA[Projects and Demos • Re: [WIP]BeatFever Mania ~ osu! Engine reimplementation]]></title>

<category term="Projects and Demos" scheme="https://love2d.org/forums/viewforum.php?f=5" label="Projects and Demos"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82021&amp;p=197091#p197091"><![CDATA[
Just want to let you know that <!-- m --><a class="postlink" href="https://github.com/danielpontello/beatfever">https://github.com/danielpontello/beatfever</a><!-- m --> is no longer a thing..<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=44056">Davidobot</a> — Sat Apr 02, 2016 9:00 am</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[Rucikir]]></name></author>
<updated>2016-04-02T08:14:46</updated>
<published>2016-04-02T08:14:46</published>
<id>https://love2d.org/forums/viewtopic.php?t=8633&amp;p=197090#p197090</id>
<link href="https://love2d.org/forums/viewtopic.php?t=8633&amp;p=197090#p197090"/>
<title type="html"><![CDATA[General • Re: Text adventures &amp; state machines (a newb approaches!)]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=8633&amp;p=197090#p197090"><![CDATA[
There's a good read imo <a href="http://gameprogrammingpatterns.com/" class="postlink">Game Programming Patterns</a>. It has a chapter on <a href="http://gameprogrammingpatterns.com/state.html" class="postlink">State Machines</a> with drawings, explanations on where and why use them, and code examples.<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=134234">Rucikir</a> — Sat Apr 02, 2016 8:14 am</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[substitute541]]></name></author>
<updated>2016-04-02T07:17:39</updated>
<published>2016-04-02T07:17:39</published>
<id>https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197089#p197089</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197089#p197089"/>
<title type="html"><![CDATA[General • Re: How to document an &quot;unusual&quot; API?]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197089#p197089"><![CDATA[
Here's an inline documentation example (after spending a while trying to understand the code) :<br /><br /><div class="codebox"><p>Code: </p><code><br />--- Chain factory<br />--<br />-- Given zero or more *link* functions, it returns a callable Chain instance.<br />--<br />-- @param function... Zero or more link functions.<br />--<br />-- @return function A Chain instance.<br />return function (...)<br />   local links = { ... }<br /><br />   --- Invoker submodule<br />   --<br />   -- @access private<br />   --<br />   -- @param index The location on where start running along the chain.<br />   -- @return function A callable Invoker object.<br />   local function Invoker(index)<br /><br />      --- Invoker object<br />      --<br />      -- Runs a link function.<br />      --<br />      -- Each link must have a first argument that takes a callback function<br />      -- `go`. Calling this function will run the next link in the chain.<br />      --<br />      -- A link may return another Chain instance instead of calling `go`. In<br />      -- this case, the next link (if any) will be appended to the returned<br />      -- Chain instance. This allows for the creation of APIs with functions<br />      -- that return chains rather than accepting callbacks.<br />      --<br />      -- A link should either call the callback function `go`, or return a<br />      -- Chain instance. It should not do both.<br />      --<br />      -- @see chain<br />      --<br />      -- @class function<br />      -- @name invoker<br />      --<br />      -- @param mixed... Extra link arguments. This can be passed by either<br />      --                 the previous link, or in the case of the first link,<br />      --                 by the Chain instance.<br />      return function (...)<br />         local link = links&#91;index&#93;<br /><br />         if not link then<br />            return<br />         end<br /><br />         local go = Invoker(index + 1)<br />         local returned = link(go, ...)<br /><br />         if returned then<br />            returned(function (_, ...) go(...) end)<br />         end<br />      end<br />   end<br /><br />   --- Chain object<br />   --<br />   -- Given several link functions, returns a new Chain instance with the link<br />   -- functions appended to the chain.<br />   --<br />   -- @class function<br />   -- @name chain<br />   --<br />   -- @param function... Link functions.<br />   -- @return function A new Chain instance, with the link functions appended<br />   --                  to the list.<br /><br />   --- Chain object<br />   --<br />   -- Run the chain links. If passed with an initial `nil` argument, the<br />   -- subsequent arguments are passed into the first link.<br />   --<br />   -- @usage<br />   --     new_chain = Chain(<br />   --         function (go, foo)<br />   --             print foo<br />   --             go('Hello Lua')<br />   --         end,<br />   --         function (go, bar)<br />   --             print bar<br />   --             go()<br />   --         end,<br />   --         function (go)<br />   --             print 'link 3'<br />   --             go()<br />   --         end,<br />   --     )<br />   --     new_chain(nil, 'Hello World') -- &gt;&gt;&gt; Hello World<br />   --                                   --   | Hello Lua<br />   --<br />   -- @class function<br />   -- @name chain<br />   --<br />   -- @param nil|mixed... Optional. An initial `nil` value, followed by the<br />   --                     extra arguments.<br /><br />   local function chain(...)<br />      if not (...) then<br />         return Invoker(1)(select(2, ...))<br />      end<br /><br />      local offset = #links<br /><br />      for index = 1, select('#', ...) do<br />         links&#91;offset + index&#93; = select(index, ...)<br />      end<br /><br />      return chain<br />   end<br /><br />   return chain<br />end<br /><br /></code></div><br /><br />Edit: going on what @ivan says, I also suggest refactoring the code and/or finding a different way to do this thing. It's incredibly confusing.<br /><br />Edit 2: There may be some <em>minor</em> errors. I suggest giving it a review if you plan on using this.<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=63719">substitute541</a> — Sat Apr 02, 2016 7:17 am</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[adekto]]></name></author>
<updated>2016-04-02T06:51:03</updated>
<published>2016-04-02T06:51:03</published>
<id>https://love2d.org/forums/viewtopic.php?t=82034&amp;p=197088#p197088</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82034&amp;p=197088#p197088"/>
<title type="html"><![CDATA[Projects and Demos • Re: [lib] maid64 - square low resolution system]]></title>

<category term="Projects and Demos" scheme="https://love2d.org/forums/viewforum.php?f=5" label="Projects and Demos"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82034&amp;p=197088#p197088"><![CDATA[
whoops, il try and fix that, im not to happy about it and will probebly change.<br /><br />maybe something not to well explained is the init parameter you can change, for example if you like the pico8 resolution:<br /><div class="codebox"><p>Code: </p><code>--initilizing maid64 for 128x128<br />    maid64(128)<br />    </code></div><p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=79341">adekto</a> — Sat Apr 02, 2016 6:51 am</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[ivan]]></name></author>
<updated>2016-04-02T06:25:17</updated>
<published>2016-04-02T06:25:17</published>
<id>https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197087#p197087</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197087#p197087"/>
<title type="html"><![CDATA[General • Re: How to document an &quot;unusual&quot; API?]]></title>

<category term="General" scheme="https://love2d.org/forums/viewforum.php?f=3" label="General"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82036&amp;p=197087#p197087"><![CDATA[
Hi there.<br />I strongly believe that having trouble naming functions or documenting them, is a sign that something is wrong with the code.<br />Looking at the code, I have a hard time figuring out what's going on, which doesn't matter right now, but it suggests that if you come back to this code yourself in a few months - you'll be scratching your head too.<br />Also, please note that you have to be careful when using &quot;local function&quot; and &quot;return function&quot; because these have their own scope which is a strain on the GC (edit: either that or affects the stack size - I have to look into it).<br />Not sure how often the code is executed, but it may affect performance and memory usage.<br />There are simple ways to avoid &quot;local function&quot; and &quot;return function&quot;.<br />For example, &quot;local links = nil&quot; could be the first line, since &quot;links&quot; is used in all of your functions.<br />Then I would move &quot;chain&quot; and &quot;Invoker&quot; outside of the returned function too.<br />Good luck. <img class="smilies" src="https://love2d.org/forums/images/smilies/ms-smile.png" alt=":)" title="Smile" /><p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=69">ivan</a> — Sat Apr 02, 2016 6:25 am</p><hr />
]]></content>
</entry>
<entry>
<author><name><![CDATA[zorg]]></name></author>
<updated>2016-04-02T04:30:13</updated>
<published>2016-04-02T04:30:13</published>
<id>https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197086#p197086</id>
<link href="https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197086#p197086"/>
<title type="html"><![CDATA[Support and Development • Re: How to serialize/deserialize a SoundData object?]]></title>

<category term="Support and Development" scheme="https://love2d.org/forums/viewforum.php?f=4" label="Support and Development"/>
<content type="html" xml:base="https://love2d.org/forums/viewtopic.php?t=82033&amp;p=197086#p197086"><![CDATA[
Hmm, could have sworn i've seen a method to refresh... or yeah, on Image objects... that can get modified data from ImageDatas <img class="smilies" src="https://love2d.org/forums/images/smilies/ms-three.png" alt=":3" title="Awww" /><br /><br />Well you might have a good solution with <a href="https://github.com/LPGhatguy/love-microphone/blob/master/love-microphone/QueueableSource.lua" class="postlink">this</a>. Queue in the sounddata, and play. Can't loop it though, sadly but i'm gonna experiment a bit with this since something was very off when i used it before.<br /><br />Also, when you say log compression on string encoding, do you mean compressing 16bit samplepoints into 8 bits? how would you get back the original 16bit fidelity though? I don't think it can be anything but lossless. Telephony log-compression like mu and a-law, like i wrote before, sacrifice enough to be (not even) decent for speech, but not music which has a greater range.<p>Statistics: Posted by <a href="https://love2d.org/forums/memberlist.php?mode=viewprofile&amp;u=80325">zorg</a> — Sat Apr 02, 2016 4:30 am</p><hr />
]]></content>
</entry>
</feed>