package me.cristaling.webtest.core;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;
import java.util.UUID;

@Entity
@Table(name = "answers")
public class Answer {

	@Id
	UUID uuid;
	UUID author;
	UUID question;
	String answer;

	public Answer() {
	}

	public UUID getUuid() {
		return uuid;
	}

	public void setUuid(UUID uuid) {
		this.uuid = uuid;
	}

	public UUID getAuthor() {
		return author;
	}

	public void setAuthor(UUID author) {
		this.author = author;
	}

	public UUID getQuestion() {
		return question;
	}

	public void setQuestion(UUID question) {
		this.question = question;
	}

	public String getAnswer() {
		return answer;
	}

	public void setAnswer(String answer) {
		this.answer = answer;
	}
}
