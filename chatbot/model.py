import pandas as pd
import numpy as np
import nltk
nltk.download('punkt')
from nltk.tokenize import word_tokenize
  
df=pd.read_csv("cauhoi.csv",delimiter=";")
tt=df.Question
Answer={}


t,c=np.unique(df.Answer,return_counts=True)

for i in range(0,len(t)):
    Answer[i]=t[i]



d=['(',')',',','.','!',' ','-','?','!','@','#','$','%','&','*','/',',',':',';','[',']','{','}','>','<','_','=','bé','cho',
    'có','con','giáo','của','gì','học','không','làm','ngày','nhà','nào','như','sẽ','sao','thế','thể','trường','tôi','viên',
    'được','ở','trẻ','những','các','thì','bị']
#Tách từ#
l=[]
words=[]
for i in range(1,len(tt)):
    w=word_tokenize(tt.iloc[i].lower())
    l.extend(w)

#Mã hóa dữ liệu cột Answer#
from sklearn.preprocessing import LabelEncoder
t=df.apply(LabelEncoder().fit_transform)
t=t.Answer

#Tìm stop_word#
words=np.unique(l)
vt={'k':'không','hog':'không','ko':'không','khg':'không',
    'bt':'biết','bk':'biết','lm':'làm','hok':'học','dc':'được',
    'vt':'viết','vc':'việc','hc':'học','j':'gì','z':'vậy','h':'giờ','đc':'được'}

for i in range(0,len(words)):
  v=words[i]
  if(v in vt):
    words[i]=vt[v]
words=np.unique(words)
index=[]
for i in range(0,len(words)):
  if words[i] in d:
    index.append(i)
words=np.delete(words,index)

#Tạo dữ liệu huấn luyện#

dt=pd.DataFrame(columns=words)
s=[]
for i in words:
    for j in range(0,len(tt)):
        a=tt.iloc[j].lower()  
        if i in a:
            s.append(1)
        else:
            s.append(0)
    dt[i]=s
    s=[]
#Lấy X,y#

X=dt
y=t

from sklearn.decomposition import PCA

# Khởi tạo đối tượng PCA với số comp = 50
my_pca = PCA (n_components = 50)

# Fit vào data
my_pca.fit(X)

# Thực hiện transform 
X=my_pca.transform(X)
X=pd.DataFrame(X)


from imblearn.over_sampling import SMOTE
smote = SMOTE(k_neighbors=1, random_state=0)
X, y = smote.fit_resample(X,y)

#Huấn luyện mô hình 
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
#cây
from sklearn import svm
from sklearn.ensemble import BaggingClassifier
s1=svm.SVC(C=100,kernel='sigmoid')
rdf=BaggingClassifier(base_estimator=s1,
                        n_estimators=100, random_state=0).fit(X, y)

import datetime
now = datetime.datetime.now()
today = now.date()
today=str(today)
import csv

def res(f):
    v=word_tokenize(f.lower())
    for i in v:
      if(i in vt):
        f=f.replace(i,vt[i])
    #Tạo DataFrame cho câu hỏi đầu vào
    ds=pd.DataFrame(columns=words)
    for i in words:
        f=f.lower()
        if i in f:
            ds[i]=[1]
        else:
            ds[i]=[0]

    #Giảm chiều dòng dữ liệuliệu
    ds=my_pca.transform(ds)
    d=rdf.predict(ds)
    #Dự đoán Answer cho câu hỏi
    tg=Answer[d[0]]
    with open('log.csv','a', encoding="utf-8") as file:
        writer = csv.writer(file,delimiter=';')
        writer.writerow([f,tg,today])
    return tg
res('học năng khiếu')
