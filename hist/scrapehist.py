
import re
import urllib


htmlFile = urllib.urlopen("http://www.bloomberg.com/quote/AAPL:US")
text = htmlFile.read()


#e = re.compile('*[^[]*>.**>')



m = re.findall(r'\{(.+?)\}',text)

for i in m:
  if (len(i)>500):
    print i

#print data 
#e.findall(data)