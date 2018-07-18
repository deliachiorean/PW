package me.cristaling.webtest.core;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;
import java.util.UUID;

@Entity
@Table(name = "questions")
public class Question {

	@Id
	UUID uuid;
	UUID author;
	String question;

	public Question() {
	}

	public UUID getUuid() {
		return uuid;
	}

	public void setUuid(UUID uuid) {
		this.uuid = uuid;
	}

	public String getQuestion() {
		return question;
	}

	public void setQuestion(String question) {
		this.question = question;
	}

	public UUID getAuthor() {
		return author;
	}

	public void setAuthor(UUID author) {
		this.author = author;
	}
}
