# LINEを嫌がる人がいるのでリアルタイムチャットをちょっと作ってみたよ
映画見ながら2時間で作ったよ！
## ただのポーリングだよ
リアルタイムといってもただのポーリングだよワッショイ！
## エスケープしてないよ！
htmlspecialcharぐらいしてよ。こわいから。  
→流石にした。
## create table
```sql
CREATE TABLE IF NOT EXISTS chat(
  id integer primary key,
  name text,
  content text,
  created_at TIMESTAMP DEFAULT (DATETIME('now','localtime'))
);
```

