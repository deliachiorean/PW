package me.cristaling.webtest.controllers.responses;

public class LoginResponse {

	boolean successful;
	String token;

	public LoginResponse(boolean successful, String token) {
		this.successful = successful;
		this.token = token;
	}

	public LoginResponse() {
	}

	public boolean isSuccessful() {
		return successful;
	}

	public void setSuccessful(boolean succesful) {
		this.successful = succesful;
	}

	public String getToken() {
		return token;
	}

	public void setToken(String token) {
		this.token = token;
	}
}
