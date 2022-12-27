#!python.exe
print('Content-type: text/html') # the mime-type header.
print() # header must be separated from body by 1 empty line.

# ## Fungsi Preprocess

# In[1]:

import numpy as np
#!pip3 install nltk
import string, re
# from nltk.tokenize import word_tokenize
def cleansing(data):
  # lower text
  #data = data.to_string()
  data = data.lower()

  # hapus punctuation
  # remove mentions
  data = re.sub('#[A-Za-z0–9_]+', '', data) # Menghapus #hashtag
  data = re.sub('@[A-Za-z0–9_]+', '', data) # Menghapus @mentions
  # data = re.sub('#', '', data) # Menghapus '#' hashtag
  data = re.sub('RT[\s]+', '', data) # Menghapus RT
  data = re.sub('https?:\/\/\S+', '', data) # Menghapus hyperlink
  data = re.sub(r"\d+", "", data) # Menghapus digit / angka
  data = data.translate(str.maketrans("","",string.punctuation)) # Menghapus tanda baca [!”#$%&’()*+,-./:;<=>?@[\]^_`{|}~]
  data = data.strip() # Menghapus white space

  # remove ASCII dan Unicode
  data = data.encode('ascii', 'ignore').decode('utf-8')
  data = re.sub(r'[^\x00-\x7f]', r'', data)

  # remove newline
  data = data.replace('\n', ' ')

  # data = nltk.tokenize.word_tokenize(data)

  return data


# In[2]:


#!pip install Sastrawi
# Inisiasi Stopword
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory, StopWordRemover, ArrayDictionary
factory = StopWordRemoverFactory()
stopwords = factory.get_stop_words()
# jalankan
stopword = factory.create_stop_word_remover()


# In[3]:


# Inisiasi Stemming
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
factory = StemmerFactory()
stemmer = factory.create_stemmer()


# In[4]:


# Inisiasi TD-IDF
#!pip install -U scikit-learn
from sklearn.feature_extraction.text import TfidfVectorizer
vectorizer = TfidfVectorizer()


# ## Impor Model Latih

# In[5]:
# go to a dir
import os
os.chdir('engine')

import joblib
filename = 'X_train.sav'
X_train = joblib.load(filename)
filename = 'y_train.sav'
y_train = joblib.load(filename)
X_train = vectorizer.fit_transform(X_train)
from sklearn.naive_bayes import MultinomialNB
from sklearn.model_selection import cross_val_score

# inisiasi Multinomial Naive Bayes
modelnb = MultinomialNB()
# latih dataset
modelnb.fit(X_train,y_train)
# back to main dir
path_parent = os.path.dirname(os.getcwd())
os.chdir(path_parent)

# ## Preprocess Data Uji

# In[6]:

#output
print("<body>")
print("<center>")
print("<h2>HASIL ANALISIS SENTIMEN</h2>")
print("<ol>")


import pandas as pd
# membaca file
#import os
#os.chdir('data')
import os
data=os.path.getsize('kompas.csv')
if not data==0:
    df_review2 = pd.read_csv("kompas.csv", encoding='latin1',usecols = [1], header=None)
    # tambahkan kolom header untuk file


    df_review2.columns = ['Tweet']
    #uji=df_review
    review = []
    for index, row in df_review2.astype(str).iterrows():
        review.append(cleansing(row['Tweet']))
    df_review2['Tweet'] = review
    review = []
    for index, row in df_review2.iterrows():
        review.append(stopword.remove(row['Tweet']))

    review = []
    for index, row in df_review2.iterrows():
        review.append(stemmer.stem(row["Tweet"]))

    len(df_review2['Tweet'])
    uji = vectorizer.transform(df_review2['Tweet'])
    output=modelnb.predict(uji)
    output
    skor=0
    a='negatif'
    x=0
    for i in output:
        if i == 'negatif':
                sen=1
        else:
                sen=0
    skor=skor+sen
    skor=skor/len(output)
    # back to main dir
    #path_parent = os.path.dirname(os.getcwd())
    #os.chdir(path_parent)


    # In[7]:
    # go to a dir
    #import os
    #os.chdir('result')

    output2=modelnb.predict_proba(uji)
    output3=output2.tolist()

    size=len(output3)
    x=[]
    xpos=0
    xnetral=0
    xneg=0
    for i in range(size):
        #print(output3[i][1])
        if output3[i][1]> 0.55:
            xpos=xpos + 1
        elif output3[i][1]< 0.45:
            xneg=xneg + 1
        else:
            xnetral= xnetral + 1

    #save
    xpos=round(xpos/len(output),3)
    xnetral=round(xnetral/len(output),3)
    xneg=round(xneg/len(output),3)
    rawan = (xneg + xnetral)/len(output)

    print("<lo><h3>Analisis Sentimen  =",xpos,'(Positive) /',xnetral,'(Neutral) /',xneg,'(Negative)/',rawan,'(Kerawanan)' "</h3></lo>")
    print("<br>")
    print("</center>")
    #np.savetxt('positive.txt',[xpos])
    #np.savetxt('netral.txt',[xnetral])
    np.savetxt('rawan.txt',[rawan])
    #print(output3)
    #path_parent = os.path.dirname(os.getcwd())
    #os.chdir(path_parent)
else:
    rawan=0;
    np.savetxt('rawan.txt',[rawan])
    print("<lo><h3>Analisis Sentimen  =",0.00,'(Positive) /',0.00,'(Neutral) /',0.00,'(Negative)/',0.00,'(Kerawanan)' "</h3></lo>")


print("<center>")
print("<h2>Proses perhitungan telah selesai</h2>");
print("<a href=");
print("index.php");
print(">");
print("<h2>BACK</h2>");
print("</a>")
print("</center>")
print("</body>");

