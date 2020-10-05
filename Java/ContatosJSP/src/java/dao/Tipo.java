/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

/**
 *
 * @author User
 */
public class Tipo {

    private String idt;
    private String nomet;

    public Tipo() {
    }

    public Tipo(String v_idt, String v_nomet) {
        this.idt = v_idt;
        this.nomet = v_nomet;
    }
    
    public String getIdt()
    {
        return idt;
    }
    
    public String getNomet()
    {
        return nomet;
    }

}
